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
    Route::get('/Pedidos/criar',[PedidoController::class, 'form']);
    Route::get('/Pedidos/create',[PedidoController::class, 'create']);
    Route::post('/Pedidos/store',[PedidoController::class, 'store']);
    Route::get('/Pedidos/edit/{id}',[PedidoController::class, 'edit']);//Pedidos/update
    Route::post('/Pedidos/update',[PedidoController::class, 'update']);//Pedidos/update
    Route::get('/Pedidos/exclude/{id}',[PedidoController::class, 'destroy']);
    Route::get('/Pedidos/editar-status/{id}',[PedidoController::class, 'editarStatus']);
    Route::post('/Pedidos/status-editado',[PedidoController::class, 'statusUpdate']);
    

    // Cliente
    Route::get('/Clientes',[ClienteController::class,'index']);
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
    Route::get('/admin/faturamento/{mes}', [AdminController::class,'analiseMes']);
    Route::get('/admin/funcionario', [AdminController::class,'funcionario']);
});






Route::get('/oi', function(){
        

     

    function enderecoRandomico($cliente){
        
        $contEnderecos = count($cliente->enderecos);
        $arrAuxiliar = [];
        $cont = 0;

        while($cont < $contEnderecos){
            array_push($arrAuxiliar,$cont);
            $cont++;
        }

        $indieRandomico = array_rand($arrAuxiliar, 1);
        return $cliente->enderecos[$indieRandomico];

    }

    function statusRandom(){
        $arr = ['Preparando pedido','Em rota de entraga','Entregue','Cancelado'];
        $indieRandomico = array_rand($arr,1);
        return $arr[$indieRandomico];
    }

    function clienteRandomico(){
        $clientes = Cliente::all();
        $tamanhoArrayCliente = count($clientes);
        $cont = 0;
        $arrAuxiliar = [];
        while($cont < $tamanhoArrayCliente - 1){
            array_push($arrAuxiliar, $cont);
            $cont++;
        }
        $indieRandomico = array_rand($arrAuxiliar, 1);
        $clienteRandomico = $clientes[$indieRandomico];
        return $clienteRandomico;
    }

    function dataRandomica(){
        
        $arrMeses = ['01','03','04','05','06','07','08','09','10','11','12'];
        $cont = 1;
        $arrDias = [];
        while($cont < 31){
            $numeroFormatado = formataDiaEmString($cont);
            
            array_push($arrDias,$numeroFormatado);
            $cont++;
        }
        $arrAnos = ['2022'];

        $arrHoras = ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];

        $arrMinutos = [];
        $arrSegundos = [];
        $contDias = 0;
        while($contDias < 60){
            $minuto = formataDiaEmString($contDias);
            array_push($arrMinutos, $minuto);
            array_push($arrSegundos, $minuto);
            $contDias++;
        }
        //dd($arrMinutos);
        

        $mesAleatorio     = retornaValorAleatorioDeArray($arrMeses);
        $diaAleatorio     = retornaValorAleatorioDeArray($arrDias);
        $anoAleatorio     = retornaValorAleatorioDeArray($arrAnos);
        $horaAleatoria    = retornaValorAleatorioDeArray($arrHoras);
        $minutoAleatoria  = retornaValorAleatorioDeArray($arrMinutos);
        $segundoAleatoria = retornaValorAleatorioDeArray($arrSegundos);
        $arr = [
            'year' => $anoAleatorio,
            'month' => $mesAleatorio,
            'day' => $diaAleatorio,
            'hour' => $horaAleatoria,
            'minutes' => $minutoAleatoria,
            'seconds' => $segundoAleatoria
        ];

        return formataData($arr);
    }

    function dataHojeComHoraRandomica(){
        $horas = [];
        $segundos = [];

        $cont = 1;
        while($cont<24){
            if ($cont < 10){
                $hora = '0'.$cont;
                $segundo = '0'.$cont;
            }else{
                $hora =  strval($cont);
                $segundo = strval($cont);
            } 

            array_push($horas, $hora);
            array_push($segundos, $segundo);
            $cont++;
        }

        while($cont >= 24 && $cont < 60){
            $segundo = strval($cont);
            array_push($segundos, $segundo);
            $cont++;
        }

        $hoje = now()->toArray();
        $hoje['hour'] = array_rand($horas,1);
        $hoje['minutes'] = array_rand($segundos,1);
        $hoje['seconds'] = array_rand($segundos,1);
        $data = formataData($hoje);
        return $data;
    }

    function formataDiaEmString($dia){
        $numString = strval($dia);
        if($dia < 10){
            $num = '0'. $numString;
        }else{
            $num = $numString;
        }

        return $num;
    }

    function retornaValorAleatorioDeArray($array){
        $indieRandomico = array_rand($array,1);

        return $array[$indieRandomico];
    }

    function formataData($arrData){
        $data = new DateTime($arrData['year'] . '-' . $arrData['month'] . '-' . $arrData['day'] . ' ' .$arrData['hour'] . ':' . $arrData['minutes'] . ':' . $arrData['seconds']);
        return $data;
    }

    function pratoRandomico(){
        $pratosIds = [1,2,4,6,7,8,9];
        $indice = array_rand($pratosIds,1);

        return $pratosIds[$indice];
    }

    function criaPedidoRandomico(){
        $pratoRandom = pratoRandomico();// indice de um prato
        $clienteRandomico = clienteRandomico();// model de cliente
        $enderecoRandomico = enderecoRandomico($clienteRandomico); // endereco randomico do cliente randomico
        $statusRandomico = statusRandom();
        $dataRandomica = /* dataRandomica();  */dataHojeComHoraRandomica();

        
        
        $pedido = $clienteRandomico->pedidos()->create([
            'prato_id' => $pratoRandom,
            'created_at' => $dataRandomica,
            'Endereco_id' => $enderecoRandomico->id,
            'status' => $statusRandomico
        ]);
    }
    function criaPedido2(){
        $contNumPedidos = 100;

        $cont = 0;

        while($cont < $contNumPedidos +1){
            criaPedidoRandomico();
            $cont++;
        }
        
        $pedidos = Pedido::all();
        dd(count($pedidos));        
    }

    
    criaPedido2();

    



    

    //$cliente = Cliente::where('id','>',13)->get();
     

     // 0(jan), 1(fev), 2(mar), 3(abr), 4(maio), 5(junho), 6(julho), 7(agosto), 8(setembro), 9(outubro), 10(novembro), 11(dezembro)

    /* $quantosDias = setDiasDoMes(9); // pego quantidade de dias do mes
    $objArrayParaGrafico = criaArrayDeDias($quantosDias);
    dd($objArrayParaGrafico); */
    
});


require __DIR__.'/auth.php';
