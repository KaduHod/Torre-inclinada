<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminController;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Prato;
use App\Models\Endereco;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function (){

    Route::get('/dashboard', [dashboardController::class, 'index']); 
    Route::get('/', function(){return redirect('/dashboard');})->name('dashboard');

    // Prato
    Route::get('/prato', [PratoController::class, 'PratoDoDiaForm']);
    Route::post('/prato/store', [PratoController::class, 'store']);
    Route::get('/prato/updateForm/{id}', [PratoController::class, 'updateForm']);
    Route::post('/prato/update', [PratoController::class, 'update']);
    Route::get('/prato/exclude/{id}',[PratoController::class, 'destroy']);

    // Pedido
    Route::get('/Pedidos',[PedidoController::class, 'index']);
    Route::get('/Pedidos/create',[PedidoController::class, 'create']);
    Route::post('/Pedidos/store',[PedidoController::class, 'store']);
    Route::get('/Pedidos/edit/{id}',[PedidoController::class, 'edit']);//Pedidos/update
    Route::post('/Pedidos/update',[PedidoController::class, 'update']);//Pedidos/update
    Route::get('/Pedidos/exclude/{id}',[PedidoController::class, 'destroy']);

    // Cliente
    Route::get('/cliente/criar',[ClienteController::class,'createForm']);
    Route::post('/cliente/salvar',[ClienteController::class,'store']);
    Route::get('/cliente/exclude/{id}',[ClienteController::class,'destroy']);
    Route::get('/cliente/edit/{id}',[ClienteController::class, 'edit']);
    Route::post('/cliente/update',[ClienteController::class, 'update']);

    // Admin
    Route::get('/admin', [AdminController::class,'index']);
    Route::get('/admin/pedidos', [AdminController::class,'pedidos']);
    Route::get('/admin/clientes', [AdminController::class,'clientes']);
    Route::get('/admin/pratos', [AdminController::class,'pratos']);
    Route::get('/admin/faturamento', [AdminController::class,'faturamento']);
});






Route::get('/oi', function(){
        

    $arrNomes = [  
        'Miguel',
        'Arthur',
        'Gael',
        'Heitor',
        'Theo',
        'Davi',
        'Gabriel',
        'Bernardo',
        'Samuel',
        'João',
        'Miguel',
        'Helena',
        'Alice',
        'Laura',
        'Maria',
        'Alice',
        'Valentina',
        'Heloísa',
        'Maria',
        'Clara',
        'Maria Cecília',
        'Maria Julia',
        'Sophia',
        'Alexandre',
        'Eduardo',
        'Henrique',
        'Murilo',
        'Theo',
        'André',
        'Enrico',
        'Henry',
        'Nathan'

    ];



    $arrEndereco = [
        'RUA G - 705 - Cajuru',
        'RUA SAO JOSE - 638 - Boa Vista',
        'RUA ONZE - 637 - Boqueirão',
        'RUA H - 627 - Bairro Novo',
        'RUA SAO PAULO - 619 - Pinheirinho',
        'RUA DOZE - 593 - Pinheirinho',
        'RUA TREZE - 585 - Pinheirinho',
        'RUA SANTO ANTONIO - 554 - Pinheirinho',
        'AVENIDA BRASIL - 532 - Pinheirinho',
        'RUA I - 507 - Pinheirinho',
        'RUA 2 - 502 - Matriz',
        'RUA 1 - 476 - Matriz',
        'RUA 3 - 460  - Matriz',
        'RUA SAO PEDRO - 458 - Matriz',
        'RUA QUINZE - 456 - Fazendinha-Portão',
        'RUA SAO JOAO - 455 - Fazendinha-Portão',
        'RUA J - 453 - Fazendinha-Portão',
        'RUA QUATORZE - 452 - Cidade Industrial de Curitiba',
        'RUA SAO FRANCISCO - 442 - Cidade Industrial de Curitiba',
        'RUA SETE DE SETEMBRO - 428 - Cidade Industrial de Curitiba',
        'RUA 4 - 425 - Cidade Industrial de Curitiba',
        'RUA DEZESSEIS - 423 - Cajuru',
        'RUA QUINZE DE NOVEMBRO - 394 - Cajuru',
        'RUA 5 - 392 - Cajuru',
        'RUA TIRADENTES - 384 - Boqueirão',
        'RUA DEZESSETE - 380 - Boqueirão',
        'RUA 6 - 378 - Boqueirão',
        'RUA L - 374 - Boa Vista',
        'RUA VINTE - 362 - Boa Vista',
        'RUA BAHIA - 360 - Boa Vista',
        'RUA AMAZONAS - 359 - Bairro Novo',
        'RUA DEZOITO - 357 - Bairro Novo',
        'RUA SAO SEBASTIAO - 357 - Bairro Novo'
    ];

    $arrIdsPratos = [1,2,4,6];

    function retornaEnderecoFormatado($arr){
        $arrFormatado = [];
        foreach($arr as $str){
            $endereco1 = explode('-',$str);
            $rua = $endereco1[0];
            $Bairro = $endereco1[2];
            $numero = $endereco1[1];
            $complemento = 'fundos';
            $cep = '0000000';
            $arr = [
                'Rua'=>$rua,
                'Bairro'=> $Bairro,
                'Numero'=> $numero,
                'Complemento'=> $complemento,
                'CEP'=> $cep
            ];
            array_push($arrFormatado,$arr);
        }
        
        return $arrFormatado;
    }
    $arrayEnderecosFormatados = retornaEnderecoFormatado($arrEndereco);
    //print_r($arrayEnderecosFormatados);
    //dd($arrayEnderecosFormatados);
    function criaCliente($str){
        $clienteNovo = Cliente::create([
            'Nome' => $str,
            'Email' => $str . '@mail.com',
            'CPF' => '0000000000',
            'Cep' => '81570000',
            'Cel' => '9944556677'
        ]);
        return $clienteNovo;
    }

    function criaEndereco($cliente, $endereco){
        $enderecoNovo = Endereco::create([
            'Rua' => $endereco['Rua'],
            'Bairro' => $endereco['Bairro'],
            'Numero' => $endereco['Numero'],
            'Complemento' => $endereco['Complemento'],
            'CEP' => $endereco['CEP'],
            'cliente_id' => $cliente->id
        ]);
        return $enderecoNovo;
    }

    function criaPedido($cliente, $endereco, $pratoId){
        $pedidoNovo = $cliente->pedidos()->create([
            'prato_id' => $pratoId,
            'Endereco_id' => $endereco->id,
            'status' => 'Preparando pedido',
            'Adendo' => 'Gorjeta se chegar em menos de 10 minutos'
        ]); 
    }

    function criaPedidos($arrNomes, $arrEnderecos, $arrPratosId){

        //$arrayEnderecosFormatados = retornaEnderecoFormatado($arrEnderecos);
        $arrPedidos = [];

        for($i = 0; $i < count($arrNomes); $i++){

            $clienteNew = criaCliente($arrNomes[$i]);

            //$enderecoNew = criaEndereco($clienteNew, $arrEnderecos[$i]);

            /* $idPrato = array_rand($arrPratosId, 1);

            $pedidoNew = criaPedido($clienteNew, $enderecoNew, $idPrato);

            array_push($arrPedidos, $pedidoNew); */

        }

        //return $arrPedidos;
    }
    //criaPedidos($arrNomes, $arrayEnderecosFormatados, $arrIdsPratos);
    //$cliente = Cliente::all();
    //dd($cliente[23]->enderecos()->get());
    //dd($novosPedidos);

    function criaPedido2($pratosIds){
        $cliente = Cliente::all();
        for($i = 0; $i < count($cliente); $i++){
            //dd(array_rand($pratosIds,1));
            //dd($cliente[$i]->enderecos()->get()[0]->id);
            $cliente[$i]->pedidos()->create([
                'prato_id' => array_rand($pratosIds,1),
                'Endereco_id' => $cliente[$i]->enderecos()->get()[0]->id,
                'status' => 'TESTE',
                'adendo' => 'TESTE'
            ]);
            
        }
    }
    //criaPedido2($arrIdsPratos);

    $cliente = Cliente::where('id','>',13)->get();
    //dd($cliente[0]->enderecos()->get());

    /* for($i = 0; $i < count($cliente); $i++){
        //$newEndereco = criaEndereco($cliente[$i], $arrayEnderecosFormatados[$i]);
        $prato = $arrIdsPratos[array_rand($arrIdsPratos,1)];
        $newPedido = criaPedido($cliente[$i], $cliente[$i]->enderecos()->get()[0], $prato);
    };  */
    
});


require __DIR__.'/auth.php';
