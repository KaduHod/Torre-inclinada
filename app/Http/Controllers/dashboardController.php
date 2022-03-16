<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prato;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;

class dashboardController extends Controller
{
    public function index(){

        $ultimo_prato_registrado = Prato::whereRaw('created_at = (select max(created_at) from  pratos)')->get()[0];
        
        $diaDoPrato = $ultimo_prato_registrado->created_at->toArray()['day'];

        $data = now()->toArray();
        $data['mes'] = getNomeMes($data['month']);

        $prato = $diaDoPrato == $data['day'] ? $ultimo_prato_registrado : false ;

        $pratos = Prato::all();

        // pedidos de hoje
            $dataInicio = $data['year'] . '-' . $data['month']  . '-' . $data['day'] . ' ' . '00:00:00' ;
            $dataFim = $data['year'] . '-' . $data['month']  . '-' . $data['day'] . ' ' . '23:59:59' ;
            $pedidos = Pedido::whereBetween('created_at',[$dataInicio,$dataFim])->orderBy('created_at','DESC')->get();
            $entregues = Pedido::where('status','Entregue')->whereBetween('created_at',[$dataInicio,$dataFim])->get();
            $cancelados = Pedido::where('status','Cancelado')->whereBetween('created_at',[$dataInicio,$dataFim])->get();
            $rotaDeEntrega = Pedido::where('status','Saiu para entrega')->whereBetween('created_at',[$dataInicio,$dataFim])->get();
            $sendoPreparados = Pedido::where('status','Preparando pedido')->whereBetween('created_at',[$dataInicio,$dataFim])->get();
            


        return view('dashboardCel', compact(
                                            'prato',
                                            'pratos',
                                            'data',
                                            'pedidos',
                                            'entregues',
                                            'cancelados',
                                            'rotaDeEntrega',
                                            'sendoPreparados')
                                        );
    }

    
}
