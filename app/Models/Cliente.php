<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;
use App\Models\Endereco;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'Nome',
        'Email',
        'CPF',
        'Endereço',
        'CEP',
        'Cel'
    ];

    public function pedidos(){// relation
        return $this->hasMany(Pedido::class);
    }

    public function enderecos(){
        return $this->hasMany(Endereco::class);
    }

    public function getPedidoDeHoje(){

        $pedidosDeHoje = [];
        $dia_de_hoje   = now()->toArray()['day'];
        $pedidos = $this->pedidos;

        foreach( $pedidos as $pedido ) {
            $dia_do_pedido = $pedido->created_at->toArray()['day'];

            if( $dia_do_pedido == $dia_de_hoje ){
                array_push( $pedidosDeHoje, $pedido );
            }
        }
        
        return $pedidosDeHoje;
    }

    public function getPedidosSendoPeparados(){
        $pedidos = $this->pedidos;
        $pedidosSendoPeparados = [];

        foreach($pedidos as $pedido){
            if($pedido->status == 'Preparando pedido'){
                array_push( $pedidosSendoPeparados, $pedido );
            }
        }

        return $pedidosSendoPeparados;

    }

    public function getPedidosSendoEntregues(){
        $pedidos = $this->pedidos;
        $pedidosSendoEntregues = [];

        foreach($pedidos as $pedido){
            if($pedido->status == 'Saiu para entrega'){
                array_push( $pedidosSendoEntregues, $pedido );
            }
        }

        return $pedidosSendoEntregues;
    }

    public function getPedidosEntregues(){
        $pedidos = $this->pedidos;
        $pedidosEntregues = [];

        foreach($pedidos as $pedido){
            if($pedido->status == 'Entregue'){
                array_push( $pedidosEntregues, $pedido );
            }
        }

        return $pedidosEntregues;
    }
}


