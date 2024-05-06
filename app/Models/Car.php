<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    public function produto()
    {
        return $this->belongsTo(Product::class, 'id_produto', 'id');
    }
}
