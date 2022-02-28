<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prato;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){

        $ultimo_prato_registrado = Prato::whereRaw('created_at = (select max(created_at) from  pratos)')->get()[0];
        
        $diaDoPrato = $ultimo_prato_registrado->created_at->toArray()['day'];

        $hoje = now()->toArray()['day'];

        $prato = $diaDoPrato == $hoje ? $ultimo_prato_registrado : false ;

        return view('dashboard2', compact('prato'));
    }
}
