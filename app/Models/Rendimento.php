<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_estudante',
        'rendimento_academico',
        'frequencia_escolar',
        'ira_curso'
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'num_matricula');
    }
}
