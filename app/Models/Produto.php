<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'quantidade',
        'status'
    ];

    protected $casts = [
        // 'descricao' => 'date', // removido: descricao é texto
        'valor' => 'decimal:2',
        'quantidade' => 'integer',
    ];
}
