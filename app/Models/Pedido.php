<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $casts = [
        'id_produto' => 'array',
        'tamanho_produto' => 'array',
        'cor_produto' => 'array',
        'quantidade_produto' => 'array',
    ];
}
