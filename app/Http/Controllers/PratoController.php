<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prato;

class PratoController extends Controller
{
    public function PratoDoDiaForm(){
        $dia_de_hoje = now()->toArray();
        $dia         = $dia_de_hoje['day'] . '/' . $dia_de_hoje['month'] . '/' . $dia_de_hoje['year'];
        
        return view('prato.form', compact('dia'));
    }
    public function store(){
        
        $floatPreco = (float)request()->all()['preco'];
       
        Prato::create([
            'Nome prato'  => request()->all()['NomePrato'],
            'Ingredientes'=> request()->all()['ingredientes'],
            'descricao'   => request()->all()['descricao'],
            'preco'       => request()->all()['preco']
        ]); 

        $msg = 'Prato do dia registrado!';
        
        return redirect('/dashboard')->with('msg', $msg);
    }
    public function updateForm($idPrato){
        $prato = Prato::findOrFail($idPrato);      

        return view('prato.formEdit', compact('prato'));
    }
    

    public function update(){

        $prato = Prato::findOrFail(request()->id);
        
        $prato['Nome prato'] = request()['NomePrato'];
        $prato->Ingredientes = request()['ingredientes'];
        $prato->descricao = request()['descricao'];
        $prato->preco = request()['preco'];
        $prato->save();
        
        return redirect('/dashboard')->with('msg','Prato do dia alterado!');
       
    }

    public function destroy($id){
        Prato::findOrFail($id)->delete();

        return back()->with('msg','Prato excluído');
    }
}
