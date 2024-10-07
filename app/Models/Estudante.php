<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_matricula',
        'nome',
        'email_estudantil',
        'curso',
        'telefone',
        'email_responsavel',
        'is_bolsista'
    ];

        // Definindo a chave primária como num_matricula
        protected $primaryKey = 'num_matricula';

        // Caso num_matricula não seja um incremento automático (auto-increment)
        public $incrementing = false;

        // Definindo o tipo da chave primária
        protected $keyType = 'integer';

        public function rendimentos()
        {
            return $this->hasMany(Rendimento::class, 'id_estudante', 'num_matricula');
        }
}
