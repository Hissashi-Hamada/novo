<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'descricao',
        'valor',
        'quantidade',
        'status'
    ];

    protected $casts = [
        'descricao' => 'date',
        'valor' => 'decimal:2',
    ];
}