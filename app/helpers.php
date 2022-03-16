<?php
use App\Models\Pedido;
use App\Models\Cliente;

// 0(jan), 1(fev), 2(mar), 3(abr), 4(maio), 5(junho), 6(julho), 7(agosto), 8(setembro), 9(outubro), 10(novembro), 11(dezembro)

function setDiasDoMes($indexMonth){
    $meses31 = [0,2,4,6,7,9,11];
    //$meses30 = [3,5,8,10];
    if($indexMonth !== 1){
        return in_array($indexMonth, $meses31) ? 31 : 30;
    }
    return 28;
}

function criaArrayDeDias($qtdDias){
    $arrDias=[];
    $arrParaDados=[];
    $cont = 0;

    while($cont < $qtdDias){
        array_push($arrDias, $cont+1);
        array_push($arrParaDados, []);
        $cont++;
    }

    $obj = new stdClass();
    $obj->dias = $arrDias;
    $obj->arrParaDados = $arrParaDados; 

    return $obj;
}

function queryDoMes($mes){// ano de 2022
    
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
    $query = Pedido::whereBetween('created_at',[$dataInicio, $dataFim]);
    /* dd([
        $dataInicio, $dataFim,$query->toSql()
    ]);
    dd( ); */

    return [$query->get(),$arrDias];
}

function inicioEfimDeMes($mes, $query){
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



function topCincoclientes($mes){
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
    //$query = Pedido::whereBetween('created_at',[$dataInicio, $dataFim]);
    //$query = Pedido::selectRaw('select cliente_id, count(cliente_id)')->whereBetween('created_at',[$dataInicio, $dataFim])->groupBy('cliente_id')->orderByRaw('count(cliente_id)')->desc();
    $query = DB::select(DB::raw("select cliente_id, count(cliente_id) from pedido where created_at between ' ". $dataInicio . "' and '" . $dataFim ."' group by cliente_id order by count(cliente_id) desc limit 5;" ));
    return $query;
    
    

}
function retornaTopClientes($query){
    $arrClientes = [];
    
    foreach($query as $cliente){
        $clienteTotPedidos = json_decode(json_encode($cliente), true)['count(cliente_id)'];
        
        $cliente = Cliente::findOrFail($cliente->cliente_id);
        
        $cliente->totPedidos = $clienteTotPedidos;
        array_push($arrClientes, $cliente);
    }
    return $arrClientes;
}
function nomeDoMes($indice){
    if($indice == '01'){
        return 'Janeiro';
    }
    if($indice == '02'){
        return 'Fevereiro';
    }
    if($indice == '03'){
        return 'Março';
    }
    if($indice == '04'){
        return 'Abril';
    }
    if($indice == '05'){
        return 'Maio';
    }
    if($indice == '06'){
        return 'Junho';
    }
    if($indice == '07'){
        return 'Julho';
    }
    if($indice == '08'){
        return 'Agosto';
    }
    if($indice == '09'){
        return 'Setembro';
    }
    if($indice == '10'){
        return 'Outubro';
    }
    if($indice == '11'){
        return 'Outubro';
    }
    if($indice == '12'){
        return 'Novembro';
    }
    
}

function criaArrayMeses(){
    $obj = array();
    $obj['janeiro']   = array();
    $obj['fevereiro'] = array();
    $obj['marco']     = array();
    $obj['abril']     = array();
    $obj['maio']      = array();
    $obj['junho']     = array();
    $obj['julho']     = array();
    $obj['agosto']    = array();
    $obj['setembro']  = array();
    $obj['outubro']   = array();
    $obj['novembro']  = array();
    $obj['dezembro']  = array();

    return $obj;
}

function separaPedidosPorDia($query, $estrutura){
    $arr = array();
    for($i = 0; $i < count($query); $i++){
        $DIAPEDIDO = $query[$i]->created_at->day;
        $PRECOPEDIDO = $query[$i]->prato->preco;
        array_push($arr[$DIAPEDIDO], $PRECOPEDIDO);
    };

    return $arr;
};
function getNomeMes($i){
        if($i == '01') return 'Janeiro';
        if($i == '02') return 'Fevereiro'; 
        if($i == '03') return 'Março';
        if($i == '04') return 'Abril'; 
        if($i == '05') return 'Maio';
        if($i == '06') return 'Junho'; 
        if($i == '07') return 'Julho';
        if($i == '08') return 'Agosto'; 
        if($i == '09') return 'Setembro';
        if($i == '10') return 'Outubro'; 
        if($i == '11') return 'Novembro';
        if($i == '12') return 'Dezembro';  
};


