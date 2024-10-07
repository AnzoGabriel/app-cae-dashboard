<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Models\Rendimento;
use App\Imports\FaltasImport;
use App\Imports\RendimentoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportPostRequest;

class ImportController extends Controller
{
    public function import(ImportPostRequest $request)
    {
        $FaltasImport = new FaltasImport;
        $RendimentoImport = new RendimentoImport;

        Excel::import($FaltasImport, $request->file('relatorio-faltas'));
        Excel::import($RendimentoImport, $request->file('relatorio-ir'));

        $data_rendimento = $RendimentoImport->data->toArray();
        $data_rendimento = array_slice($data_rendimento, 1);


        // RELATÓRIO DE IR - CRIAÇÃO DE ARRAY COM OS DADOS FORMATADOS
        foreach ($data_rendimento as $data_info => $value) {
            $data_rendimento_formatter[] = [
                $value[1],
                preg_replace('/\s*\(.*?\)$/', '', $value[2]),
                floatval(str_replace(',', '.', $value[4])),
                floatval(str_replace('%', '', str_replace(',', '.', $value[5]))),
                floatval(str_replace(',', '.', $value[6])),
            ];
        }

        // RELATÓRIO DE FALTAS - CRIAÇÃO DE ARRAY COM OS DADOS FORMATADOS


        $data_faltas = $FaltasImport->data->toArray();
        $data_faltas = array_slice($data_faltas, 2);

        foreach ($data_faltas as $data_info_faltas => $value) {
            $data_faltas_formater[] = [
                intval($value[0]),
                $value[1],
                $value[10],
                $value[11],
            ];
        }

        foreach ($data_faltas_formater as $item => $value) {
            foreach ($data_rendimento_formatter as $item_r => $value_r) {
                if ($value[1] == $value_r[0]) {
                    $data_formater[] = [
                        'num_matricula' => $value[0],
                        'nome' => $value_r[0],
                        'email_estudantil' => $value[2],
                        'telefone' => $value[3],
                        'curso' => $value_r[1],
                        'rendimento_academico' => $value_r[2],
                        'frequencia_escolar' => $value_r[3],
                        'ira_curso' => $value_r[4],
                    ];
                }
            }
        }

        // Extraindo os números de matrícula dos dados formatados
        $matriculas_importadas = collect($data_formater)->pluck('num_matricula');

        // Extraindo os números de matrícula dos estudantes já no banco
        $matriculas_existentes = Estudante::pluck('num_matricula');

        // Usando diff() para descobrir quais estudantes estão no relatório mas não no banco
        $matriculas_novas = $matriculas_importadas->diff($matriculas_existentes);


        $novos_estudantes = collect($data_formater)->whereIn('num_matricula', $matriculas_novas);

        foreach ($novos_estudantes as $item) {

            $estudante = Estudante::create([
                'num_matricula' => $item['num_matricula'],
                'nome' => $item['nome'],
                'email_estudantil' => $item['email_estudantil'],
                'curso' => $item['curso'],
                'telefone' => $item['telefone'],
            ]);


            Rendimento::create([
                'id_estudante' => $estudante->num_matricula,
                'rendimento_academico' => $item['rendimento_academico'],
                'frequencia_escolar' => $item['frequencia_escolar'],
                'ira_curso' => $item['ira_curso']
            ]);
        }

        $estudantes_existentes = collect($data_formater)->whereIn('num_matricula', $matriculas_existentes);

        foreach ($estudantes_existentes as $item) {
            $estudante = Estudante::where('num_matricula', $item['num_matricula'])->first();

            // Verificar se o estudante foi reativado como bolsista
            if (!$estudante->is_bolsista) {
                $estudante->update(['is_bolsista' => true]);
            }

            // Atualiza o rendimento apenas se o estudante for bolsista
            if ($estudante->is_bolsista) {
                // Adiciona o rendimento mensal se o estudante ainda for bolsista
                Rendimento::create([
                    'id_estudante' => $estudante->num_matricula,
                    'rendimento_academico' => $item['rendimento_academico'],
                    'frequencia_escolar' => $item['frequencia_escolar'],
                    'ira_curso' => $item['ira_curso']
                ]);
            }
        }

        // Verificar estudantes que não estão no relatório importado e desativá-los como bolsistas
        $matriculas_nao_importadas = $matriculas_existentes->diff($matriculas_importadas);

        Estudante::whereIn('num_matricula', $matriculas_nao_importadas)->update(['is_bolsista' => false]);


        dd('DEU CERTO \0/');

        return view('dashboard.home');
    }
}
