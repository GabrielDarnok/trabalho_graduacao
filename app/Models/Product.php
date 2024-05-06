<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $dates = ['date'];

    protected $guarded = [];

    protected $casts = [
        'tamanho_roupa' => 'array',
        'cor_produto' => 'array'
    ];
}
