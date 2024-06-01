<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario', // Adicione outros campos conforme necessário
        'number_phone',
    ];

    // Definir a relação belongsTo com User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
