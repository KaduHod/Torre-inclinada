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
        return redirect('/Pedido');
    }
    public function clientes(){
        return redirect('/Clientes');
    }
    public function pratos(){
        $pratos = Prato::all();

        return view('admin.pratos', compact('pratos'));
    }

    public function faturamento(){        

        return view('admin.faturamento');
    }

    public function funcionario(){
        return view('admin.createFuncionario');
    }

    public function storeFuncionario(){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('msg','Funcionario registrado');
    }

    public function updateFuncionario(){

    }

    public function analiseMes($mes){
        $query = queryDoMes($mes);

        $pedidos = $query[0];// pedidos
        $arrAuxiliar = $query[1];// array que ajuda a criar o grafico
        $nomeMes = nomeDoMes($mes);// nome do mes solicitado de analise

        $pratos = Prato::all();


        $queryNovosClientes = Cliente::query();
        $NovosClientes = $this->inicioEfimDeMes($mes,$queryNovosClientes);
        $qtdNovosClientes = $NovosClientes->count();// quantidade de novos clientes
        
        $TopCincoclientes = retornaTopClientes(topCincoclientes($mes));// helpers
       
        return view('admin.analiseMes', compact(
            'pedidos',
            'arrAuxiliar',
            'nomeMes',
            'pratos',
            'TopCincoclientes',
            'qtdNovosClientes'
        ));
        
    }

    private function inicioEfimDeMes($mes, $query){
        $trintaDias = ['04','06','09','11'];
    
        $verificaFevereiro = $mes == '02' ? true : false;
        $verificaTrinta    = array_search($mes, $trintaDias) > -1 ? true : false;
        $verificaTrintaEUm = !$verificaFevereiro && !$verificaTrinta ? true : false;
    
        if($verificaFevereiro){
            $dataInicio = '2022-' . $mes . '-01 00:00:00';
            $dataFim = '2022-' . $mes . '-28 23:59:59';
    
            $arrDias = criaArrayDeDias(28);
        }
        if($verificaTrinta){
            $dataInicio = '2022-' . $mes . '-01 00:00:00';
            $dataFim = '2022-' . $mes . '-30 23:59:59';
            $arrDias = criaArrayDeDias(30);
        }
        if($verificaTrintaEUm){
            $dataInicio = '2022-' . $mes . '-01 00:00:00';
            $dataFim = '2022-' . $mes . '-31 23:59:59';
            $arrDias = criaArrayDeDias(31);
        }
    
        $query->whereBetween('created_at',[$dataInicio,$dataFim]);
        return $query;
    }

    

}



