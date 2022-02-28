<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Pedido;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'Rua',
        'Bairro',
        'Numero',
        'Complemento',
        'CEP'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id');
    }
    public function pedido(){
        return $this->belongsToMany(Pedido::class);
    }
}
