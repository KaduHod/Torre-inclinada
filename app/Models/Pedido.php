<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Prato;
use App\Models\User;
use App\Models\Endereco;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';

    protected $fillable = [
        'cliente_id',
        'prato_id',
        'Endereco_id',
        'status',
        'funcionario_id',
        'created_at'
    ];

    public function cliente(){// relation
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

    public function prato(){// relation
        return $this->hasOne(Prato::class,'id','prato_id');
    }

    public function funcionario(){
        return $this->belongsTo(User::class,'funcionario_id');
    }

    public function Endereco(){
        return $this->hasOne(Endereco::class,'id','Endereco_id');
    }
    
}
