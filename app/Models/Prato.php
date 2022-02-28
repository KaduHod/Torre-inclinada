<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class Prato extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nome prato',
        'Ingredientes',
        'descricao',
        'preco'
    ];

    public function pedido(){// relation

        return $this->hasMany(Pedido::class);

    }
}
