<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Prato;


class AdminController extends Controller
{
    public function index(){
        // pegar todos os pedidos
        // todos os cliente
        /**
         * listar pedidos
         * listar clientes
         * listar pratos
         * faturamento
         *  - hoje
         *  - semana
         *  - mes
         **/
        $clientesTot = count(Cliente::all());
        $pedidosTot = count(Pedido::all());
        $pratosTot = count(Prato::all());
        $clientes = Cliente::all();
        $pedidos = Pedido::all();
        $pratos = Prato::all();

        //dd($pedidos);
        $totalFaturamento = 0;
        foreach($pedidos as $pedido){
            $totalFaturamento +=  $pedido->prato->preco;
        }
        //dd($totalFaturamento);
        

        

        return view('admin.index', compact(
            'clientesTot',
            'pedidosTot',
            'pratosTot',
            'clientes',
            'pedidos',
            'pratos',
            'totalFaturamento'
            )
        );

    }

    public function pedidos(){
        $pedidos = Pedido::all();

        return view('admin.pedidos', compact('pedidos'));
    }
    public function clientes(){
        $clientes = Cliente::all();

        return view('admin.clientes', compact('clientes'));
    }
    public function pratos(){
        $pratos = Prato::all();

        return view('admin.pratos', compact('pratos'));
    }

    public function faturamento(){
        $pedidos = Pedido::whereBetween('created_at', ['2022-02-01 00:00:00', '2022-02-28 23:59:59'])->get();
        
        $pedidos_separados_por_dia = separaPedidosPorDia($pedidos);

        //dd($pedidos_separados_por_dia);

        return view('admin.faturamento', compact('pedidos_separados_por_dia'));
    }

}

function separaPedidosPorDia($query){
    $arrDias = [
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        []
    ];

    for($i = 0; $i < count($query); $i++){
        $DIAPEDIDO = $query[$i]->created_at->day;
        $PRECOPEDIDO = $query[$i]->prato->preco;
        array_push($arrDias[$DIAPEDIDO], $PRECOPEDIDO);
    };

    return $arrDias;
};

/* function separaPedidosPorMes($pedidos){
    $arrMeses = [
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        []
    ];

    foreach($pedidos as $pedido){
        $mesPedido;
    }
} */