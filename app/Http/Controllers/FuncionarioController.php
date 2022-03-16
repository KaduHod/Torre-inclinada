<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    public function index(){
        $funcionarios = User::all();
        return view('admin.funcionarioIndex',compact('funcionarios'));
    }
    public function create(){
        return view('admin.createFuncionario');
    }

    public function store(){
        $request = request();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'staff' => $request->staff
        ]);

        return redirect('/admin/funcionario')->with('msg','Funcionario registrado');
    }

    public function edit($id){
        $funcionario = User::findOrFail($id);

        return view('admin.editFuncionario', compact('funcionario'));
    }

    public function update(){
        $request = request();
        $funcionario = User::findOrFail($request->id);

        $funcionario->name = $request->name;
        //$funcionario->email = $request->email;
        //$funcionario->password = $request->password;
        $funcionario->staff = $request->staff;

        $funcionario->save();

        return redirect('/admin')->with('msg','Funcionario alterado!');
    }
    public function delete($id){
        $funcionario = User::findOrFail($id);

        if(Auth::user()->id == $id || $id == 1){
            return redirect('/');
        }

        $funcionario->delete();

        return back()->with('msg','Funcionario excluído!');

    }

    public function simulate($id){
        $userLogado = Auth::user();
        
        $verifica = ($userLogado->staff == 'Admin' || $userLogado->staff == 'Desenvolvedor') ? true : false;
        
        if(!$verifica) abort(403);

        $user = User::findOrFail($id);
        Auth::logout();
        \Session::flush();

        Auth::login($user);

        return redirect('/')->with('msg','Login trocado');
    }
}
