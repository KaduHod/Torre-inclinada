<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Prato;
use App\Models\Endereco;
use App\Models\Cliente;


class PedidoController extends Controller
{
    public function index(){
        $pedidosSendoPeparados = count( getPedidosSendoPeparados() );
        $pedidosSendoEntregues = count( getPedidosSendoEntregues() );
        $pedidosEntregues      = count( getPedidosEntregues() );
        $pedidoDeHoje          = count( getPedidosDeHoje() );

        return view('pedidos.index', compact(
            'pedidosSendoPeparados',
            'pedidosSendoEntregues',
            'pedidosEntregues',
            'pedidoDeHoje'
        ));
    }

    public function create(){
        $pratos = Prato::all();
        $clientes = Cliente::all();
        
        
        return view('pedidos.create', compact('pratos','clientes'));
    }

    public function store(){
        
         if(request()->idClienteJaRegistrado){// cliente ja registrado

            $cliente = Cliente::findOrFail(request()->idClienteJaRegistrado);

            if(request()->enderecos == 'novoEndereco'){
                
                $novoEndereco = Endereco::create([
                    'Rua' => request()['NOVOENDERECO:_Rua'],
                    'Bairro' => request()['NOVOENDERECO:_Bairro'],
                    'Complemento' => request()['NOVOENDERECO:_Complementos'],
                    'CEP' => request()['NOVOENDERECO:_CEP'],
                    'Numero' => request()['NOVOENDERECO:_Número'],
                    'cliente_id' => $cliente->id,
                ]);

                $cliente->pedidos()->create([
                    'cliente_id' => $cliente->id,
                    'prato_id' => request()->Prato,
                    'Endereco_id' => $novoEndereco->id,
                    'status' => 'Preparando pedido',
                    'adendo' => request()->AdendoPedido
                ]); 

                return redirect('/dashboard')->with('msg','Pedido cadastrado!');
                
                
            }else{

                $cliente->pedidos()->create([
                    'cliente_id' => $cliente->id,
                    'prato_id' => request()->Prato,
                    'Endereco_id' => request()->enderecos,
                    'status' => 'Preparando pedido',
                    'adendo' => request()->AdendoPedido
                ]);

                return redirect('/dashboard')->with('msg','Pedido cadastrado!');
                
            }

            

        }else{// cliente novo
            $novoCliente = Cliente::create([
                                            'Nome'  => request()->NomeCliente,
                                            'Email' => request()->EmailCliente,
                                            'CPF'   => request()->CPFCliente,
                                            'CEP'   => request()->CEPNovoCliente,
                                            'Cel'   => request()->CelCliente
                                            ]);
            $novoEndereco = Endereco::create([
                                            'Rua'        => request()['RuaNovoCliente'],
                                            'Bairro'     => request()['BairroNovoCliente'],
                                            'Complemento' => request()['ComplementoNovoCliente'],
                                            'CEP'        => request()['CEPNovoCliente'],
                                            'Numero'     => request()['NumeroNovoCliente'],
                                            'cliente_id' => $novoCliente->id,
                                            ]);            

            $novoCliente->pedidos()->create([
                                            //'cliente_id' =>$novoCliente->id,
                                            'prato_id' => request()->Prato,
                                            'Endereco_id' => $novoEndereco->id,
                                            'status' => 'Preparando pedido',
                                            'adendo' => request()->AdendoPedido
                                            ]);

            return redirect('/dashboard')->with('msg','Pedido cadastrado!');
            
        }
    }

    public function edit($id){
        $pedido = Pedido::findOrFail($id);
        $pratos = Prato::all();
        $clientes = Cliente::all();

        return view('pedidos.edit', compact('pedido','clientes','pratos'));
    }

    public function update(){
        $tipoRequest = tipoRequest(request()->all());
        //dd(request()->all());
        $pedido = Pedido::findOrFail(request()->idPedido);
        //dd($pedido);
        
        if($tipoRequest == 'Cliente Registrado com endereco registrado')
        {


            $pedido->prato_id       = request()->Prato;
            $pedido->Endereco_id = request()->enderecos;
            $pedido->cliente_id  = request()->id_clienteSearch;
            $pedido->adendo      = request()->AdendoPedido;

            $pedido->save();

        }
        if($tipoRequest == 'Cliente Registrado com novo endereco')
        {

            $clienteReg = Cliente::findOrFail(request()->id_clienteSearch);
            $EnderecoNovo = Endereco::create([
                                            'Rua'         => request()['NOVOENDERECO:_Rua'],
                                            'Bairro'      => request()['NOVOENDERECO:_Bairro'],
                                            'Numero'      => request()['NOVOENDERECO:_Número'],
                                            'Complemento' => request()['NOVOENDERECO:_Complementos'],
                                            'CEP'         => request()['NOVOENDERECO:_CEP'],
                                            'cliente_id'  => request()->id_clienteSearch
                                            ]);
            
            $pedido->cliente_id  = $clienteReg->id;
            $pedido->prato_id       = request()->Prato;
            $pedido->Endereco_id = $EnderecoNovo->id;
            $pedido->adendo      = request()->AdendoPedido; 
            $pedido->save();

        }
        if($tipoRequest == 'Novo cliente')
        {

            $novoCliente = Cliente::create([
                                            'Nome'  => request()->NomeCliente,
                                            'Email'  => request()->EmailCliente,
                                            'CPF'  => request()->CPFCliente,
                                            'CEP'  => request()->CEPNovoCliente,
                                            'Cel'  => request()->CelCliente    
                                            ]);


            $novoEndereco = Endereco::create([
                                            'Rua'         => request()->RuaNovoCliente,
                                            'Bairro'      => request()->BairroNovoCliente,
                                            'Numero'      => request()->NumeroNovoCliente,
                                            'Complemento' => request()->ComplementoNovoCliente,
                                            'CEP'         => request()->CEPNovoCliente,
                                            'cliente_id'  => $novoCliente->id            
                                            ]);


            $pedido->cliente_id  = $novoCliente->id;
            $pedido->prato_id       = request()->Prato;
            $pedido->Endereco_id = $novoEndereco->id;
            $pedido->adendo      = request()->AdendoPedido; 
            $pedido->save();
        }

        return redirect('/admin/pedidos')->with('msg','Pedido atualizado com sucesso!');


    }
    
    public function destroy($id){
        $pedido = Pedido::findOrFail($id)->delete();

        return back()->with('msg','Pedido excluído!');
    }
    
}

function tipoRequest($request){
    if(count($request) === 7)  return 'Cliente Registrado com endereco registrado';
    if(count($request) === 11) return 'Cliente Registrado com novo endereco';
    if(count($request) === 14) return 'Novo cliente';
}


function getPedidosDeHoje(){
    $pedidos = Pedido::all();
    $pedidosDeHoje = [];
    $dia_de_hoje   = now()->toArray()['day'];

    foreach($pedidos as $pedido){
        $dia_do_pedido = $pedido->created_at->toArray()['day'];
        if($dia_do_pedido == $dia_de_hoje){
            array_push( $pedidosDeHoje, $pedido );
        }
    }

    return $pedidosDeHoje;
}

function getPedidosSendoPeparados(){
    $pedidos = Pedido::where('status','=','Preparando pedido')->get();
    return $pedidos;
}

function getPedidosSendoEntregues(){
    $pedidos = Pedido::where('status','=','Saiu para entrega')->get();
    return $pedidos;
}

function getPedidosEntregues(){
    $pedidos = Pedido::where('status','=','Entregue')->get();
    return $pedidos;
}
