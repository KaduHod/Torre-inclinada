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
        $request = request();
        $query = Pedido::query();
        $totPedidos = Pedido::count();
        $query = $this->filtersFromRequest($request, $query);
        $TotalDeRegistrosDaPesquisa = $query->count();
        $pedidos = $query->paginate(30);
        //dd($pedidos);
        return view('admin.pedidos', compact('pedidos','totPedidos','TotalDeRegistrosDaPesquisa'));
    }

    public function form(){
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
        
        
        return view('pedidos.createCel', compact('pratos','clientes'));
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

        return redirect('/Pedidos')->with('msg','Pedido atualizado com sucesso!');


    }
    
    public function destroy($id){
        $pedido = Pedido::findOrFail($id)->delete();

        return back()->with('msg','Pedido excluído!');
    }

    public function editarStatus($id){
        $pedido = Pedido::findOrFail($id);
        return view ('pedidos.editStatusCel',compact('pedido'));
    }

    public function statusUpdate(){
        //dd(request()->all());
        $pedido = Pedido::findOrFail(request()->idPedido);
        $pedido->status = request()->Status;
        $pedido->save();

        return redirect('/dashboard')->with('msg','Status do pedido atualizado!');
    }

    private function filtersFromRequest($request, $query){
        $idsPedidos = [];
        $arrIdsEnderecos = [];
        
        if($request->has('Nome') && !empty($request->Nome)){
            
            $arrIdsClientes = [];
            $cliente = Cliente::where('Nome','LIKE', '%' . $request->Nome . '%' )->get();
            if(count($cliente) != 0 ){
                foreach($cliente as $client){
                    array_push($arrIdsClientes, $client->id);
                }
                $query->whereIn('cliente_id', $arrIdsClientes);
            }
            

        }
        if($request->has('prato') && !empty($request->prato)){
            
            $arrIdsPrato = [];
            $prato = Prato::where('Nome prato', 'LIKE','%' . $request->prato . '%')->get();
            if(count($prato) != 0 ){
                foreach($prato as $food){
                    array_push($arrIdsPrato, $food->id);
                }
                $query->whereIn('prato_id',  $arrIdsPrato);
            }
        }
        if(!empty($request->enderecoRua) || !empty($request->enderecoNumero) || !empty($request->enderecoBairro)){
            
            
            if($request->has('enderecoRua') && !empty($request->enderecoRua)){
                
                $EnderecoRua = Endereco::where('Rua','LIKE','%' . $request->enderecoRua .'%')->get();
                //dd('até agora tudo certo');
                if(count($EnderecoRua) != 0){
                    foreach($EnderecoRua as $pedido){
                        array_push($arrIdsEnderecos, $pedido->id);
                    }
                }
                
            }
            
             if($request->has('enderecoNumero') && !empty($request->enderecoNumero)){
                
                $EnderecoNum = Endereco::where('Numero','LIKE','%' . $request->enderecoNumero .'%')->get();
                if(count($EnderecoNum) != 0){
                    foreach($EnderecoNum as $pedido){
                        array_push($arrIdsEnderecos, $pedido->id);
                    }
                }
                
            } 
            
            if($request->has('enderecoBairro') && !empty($request->enderecoBairro)){
                $EnderecoBairro = Endereco::where('Bairro','LIKE','%' . $request->enderecoBairro . '%')->get();
                
                if(count($EnderecoBairro) != 0){
                    foreach($EnderecoBairro as $pedido){
                        array_push($arrIdsEnderecos, $pedido->id);
                    }
                }
            }


            $query->whereIn('Endereco_id',$arrIdsEnderecos);
            
        }
        
        if($request->has('status') && !empty($request->status)){
             $status = Pedido::where('status','LIKE',"%". $request->status . '%')->get();
            if(count($status) != 0){
                foreach($status as $pedido){
                    array_push($idsPedidos,$pedido->id);
                }
                
            }
        }
        if($request->has('Funcionario') && !empty($request->Funcionario)){
            
        }
        
        if(
            $request->has('DataPedidoInicio') && !empty($request->DataPedidoInicio) &&
            $request->has('DataPedidoFim') && !empty($request->DataPedidoFim)
        ){
            
            $dataInicio = (new \DateTime($request->DataPedidoInicio))->format('Y-m-d') . ' 00:00:00';
            $dataFim =  (new \DateTime($request->DataPedidoFim))->format('Y-m-d') . ' 23:59:59';          

            $query->whereBetween('created_at',[$dataInicio, $dataFim ]);
            //dd([$dataInicio, $dataFim ]);
            
            //dd($query->toSql());
        }
        if(
            $request->has('DataPedidoInicio') && !empty($request->DataPedidoInicio) &&
            $request->has('DataPedidoFim') && empty($request->DataPedidoFim)
        ){
            
            
            $dataInicio = (new \DateTime($request->DataPedidoInicio))->format('Y-m-d'). ' 00:00:00';
            $dataFim = (new \DateTime($request->DataPedidoInicio))->format('Y-m-d'). ' 23:59:59';
            $query->whereBetween('created_at',[$dataInicio, $dataFim ]);
        }
        if(
            $request->has('DataPedidoInicio') && empty($request->DataPedidoInicio) &&
            $request->has('DataPedidoFim') && !empty($request->DataPedidoFim)
        ){
            
            $dataInicio = (new \DateTime($request->DataPedidoFim))->format('Y-m-d'). ' 00:00:00';
            $dataFim = (new \DateTime($request->DataPedidoFim))->format('Y-m-d'). ' 23:59:59';
            $query->whereBetween('created_at',[$dataInicio, $dataFim ]);
        }

        if($request->has('Alterado') && !empty($request->Alterado)){
            $dataInicio = (new \DateTime($request->Alterado))->format('Y-m-d'). ' 00:00:00';
            $dataFim = (new \DateTime($request->Alterado))->format('Y-m-d'). ' 23:59:59';
            $query->whereBetween('updated_at',[$dataInicio, $dataFim ]);
        }
        if($request->has('Cep') && !empty($request->Cep)){
            $pedidosCep = Endereco::where('Cep','=', $request->Cep )->get();
                //dd('até agora tudo certo');
                if(count($pedidosCep) != 0){
                    foreach($pedidosCep as $endereco){
                        array_push($arrIdsEnderecos, $endereco->id);
                    }
                }
        }
        
        if(count($idsPedidos)>0)$query->whereIn('id',$idsPedidos);
        
        
        //dd($query->toSql());
        return $query;
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
