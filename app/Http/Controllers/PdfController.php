<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Prato;
use PDF;

class PdfController extends Controller
{
    public function gerarPDF(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('pdf.teste');
        return $pdf->setPapper('a4')->stream('Relatório');// _> douwnload
    }
    public function listarPedidos(){
        $pedidos = Pedido::where('status','Entregue')->limit('500')->get();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('pdf.teste',compact('pedidos'));
        return $pdf->stream('Relatório');// _> douwnload
    }
    public function relatorioMes($mes){
        $nomeMes = getNomeMes($mes);
        $query = queryDoMes($mes);
        $pedidos = $query[0];// pedidos
        $arrAuxiliar = $query[1];// array que ajuda a criar o grafico
        $nomeMes = nomeDoMes($mes);// nome do mes solicitado de analise
        $pratos = Prato::all();
        $queryNovosClientes = Cliente::query();
        $NovosClientes = inicioEfimDeMes($mes,$queryNovosClientes);
        $qtdNovosClientes = $NovosClientes->count();// quantidade de novos clientes
        $TopCincoclientes = retornaTopClientes(topCincoclientes($mes));// helpers

        //Lucro total, Entregues, Cancelados
            $lucro = 0;
            $entregues = 0;
            $cancelados = 0;
            foreach($pedidos as $pedido){
                $lucro += $pedido->prato->preco;
                if($pedido->status == 'Entregue') $entregues++;
                if($pedido->status == 'Cancelado') $cancelados++;
            }

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('pdf.teste2',compact(
            'nomeMes',
            'lucro',
            'qtdNovosClientes',
            'pedidos',
            'entregues',
            'cancelados',
            'TopCincoclientes'
        ));
        return $pdf->download( $nomeMes . 'Relatório.pdf');// _> douwnload
    }
}
