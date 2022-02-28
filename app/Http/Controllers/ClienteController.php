<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Endereco;

class ClienteController extends Controller
{
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
        //dd(request()->all());
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
}
