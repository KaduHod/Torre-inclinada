<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Endereco;

class ClienteController extends Controller
{
    public function index(){
        $totCliente = Cliente::count();

        $request = request();
        $query = Cliente::query();
        
        $query = $this->filtersFromRequest($request, $query);
        $query = $query->paginate(50);

        return view('admin.clientes', compact('query','totCliente'));
    }
    public function createForm(){
        return view('cliente.create');
    }

    public function store(){

        $cliente = Cliente::create([
            'Nome'  => request()->NomeCliente,
            'Email' => request()->EmailCliente,
            'CPF'   => request()->CPFCliente,
            'CEP'   => request()->CEPCliente,
            'Cel'   => request()->CelCliente
        ]);

        $cliente->enderecos()->create([
            'Rua'         => request()->RuaCliente,
            'Bairro'      => request()->BairroCliente,
            'Numero'      => request()->NumeroCliente,
            'Complemento' => request()->ComplementoCliente,
            'Cep'         => request()->CepCliente
        ]);
        
        return redirect('/dashboard')->with('msg','Cliente registrado!');
    }

    public function edit($id){
        $cliente = Cliente::findOrFail($id);

        return view('cliente.edit', compact('cliente'));
    }
    public function destroy($id){
        $pedido = Cliente::findOrFail($id)->delete();

        return back()->with('msg','Cliente excluído!');
    }
    public function update(){
        $cliente = Cliente::findOrFail(request()->idCliente);
        $cliente->Nome = request()->NomeCliente;
        $cliente->Email = request()->EmailCliente;
        $cliente->CPF = request()->CPFCliente;
        $cliente->CEP = request()->CepCliente;
        $cliente->Cel = request()->CelCliente;

        if(request()->enderecos == 'novoEndereco'){
            $cliente->enderecos()->create([
                'Rua' => request()->RuaCliente,
                'Bairro' => request()->BairroCliente,
                'Numero' => request()->NumeroCliente,
                'Complemento' => request()->ComplementoCliente,
                'CEP' => request()->CepClienteEndereco
            ]);
        }else{
            $endereco = Endereco::findOrFail(request()->enderecos);
            $endereco->Rua = request()->RuaCliente;
            $endereco->Bairro = request()->BairroCliente;
            $endereco->Numero = request()->NumeroCliente;
            $endereco->Complemento = request()->ComplementoCliente;
            $endereco->CEP = request()->CepClienteEndereco;
            $endereco->save();
        }
        $cliente->save();

        return redirect('/admin/clientes')->with('msg','Cliente atualizado!');
        
    }

    private function filtersFromRequest($request, $query){
        $idsClientes = [];
        
        
        if($request->has('Nome') && !empty($request->Nome)){
            
            $cliente = Cliente::where('Nome','LIKE', '%' . $request->Nome . '%' )->get();
            if(count($cliente) != 0 ){
                foreach($cliente as $client){
                    $idsClientes = pushValorNovo($idsClientes,$client->id);
                    
                }
            }
            

        }
        
        if($request->has('email') && !empty($request->email)){
            $query->where('Email','=',$request->email);
        }
        
        if(!empty($request->enderecoRua) || !empty($request->enderecoNumero) || !empty($request->enderecoBairro)){
            
            if($request->has('enderecoRua') && !empty($request->enderecoRua)){
                
                $EnderecoRua = Endereco::where('Rua','LIKE','%' . $request->enderecoRua .'%')->get();
                if(count($EnderecoRua) != 0){
                    foreach($EnderecoRua as $endereco){
                        array_push($idsClientes,$endereco->cliente_id);
                    }
                }
                
            }
            
            
             if($request->has('enderecoNumero') && !empty($request->enderecoNumero)){
                
                $EnderecoNum = Endereco::where('Numero','LIKE','%' . $request->enderecoNumero .'%')->get();
                if(count($EnderecoNum) != 0){
                    foreach($EnderecoNum as $endereco){
                        array_push($idsClientes,$endereco->cliente_id);
                    }
                }
                
            } 
            
            
            if($request->has('enderecoBairro') && !empty($request->enderecoBairro)){
                $EnderecoBairro = Endereco::where('Bairro','LIKE','%' . $request->enderecoBairro . '%')->get();
                
                if(count($EnderecoBairro) != 0){
                    foreach($EnderecoBairro as $endereco){
                        array_push($idsClientes,$endereco->cliente_id);
                    }
                }
            }            
        }
        if($request->has('CPF') && !empty($request->CPF)){
            $query->where('CPF','=',$request->CPF);          
        }
        if($request->has('cel') && !empty($request->cel)){
            $query->where('Cel','=',$request->cel);          
        }
        
        if(
            $request->has('DataPedidoInicio') && !empty($request->DataPedidoInicio) &&
            $request->has('DataPedidoFim') && !empty($request->DataPedidoFim)
        ){
            
            $dataInicio = (new \DateTime($request->DataPedidoInicio))->format('Y-m-d') . ' 00:00:00';
            $dataFim =  (new \DateTime($request->DataPedidoFim))->format('Y-m-d') . ' 23:59:59';          
            $query->whereBetween('created_at',[$dataInicio, $dataFim ]);
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
        
        
        if(count($idsClientes)>0)$query->whereIn('id',array_unique($idsClientes));
        
        //dd($query->toSql());
        return $query;
    }
    
}


