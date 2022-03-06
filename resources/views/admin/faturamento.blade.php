
@extends('layouts.main')

@section('title','Torre Inlcinada Dashboard')
@section('content')
<div id='AdminDashboard'>
    {{-- <div id="OptionsAdmin" class="border">   
        <ul>
            <li>Faturamento por mes</li>
            <li>Pedidos por mes</li>
            <li>Novos clientes por mes</li>
            
        </ul>
    </div> --}}
    <h1>2022</h1>
    <a class="Month " href="/admin/faturamento/01">
        Janeiro
    </a>
    <a class="Month " href="/admin/faturamento/02">
        Fevereiro
    </a>
    <a class="Month " href="/admin/faturamento/03">
        Março
    </a>
    <a class="Month " href="/admin/faturamento/04">
        Abril
    </a>
    <a class="Month " href="/admin/faturamento/05">
        Maio
    </a>
    <a class="Month " href="/admin/faturamento/06">
        Junho
    </a>
    <a class="Month " href="/admin/faturamento/07">
        Julho
    </a>
    <a class="Month " href="/admin/faturamento/08">
        Agosto
    </a>
    <a class="Month " href="/admin/faturamento/09">
        Setembro
    </a>
    <a class="Month " href="/admin/faturamento/10">
        Outubro
    </a>
    <a class="Month " href="/admin/faturamento/11">
        Novembro
    </a>
    <a class="Month " href="/admin/faturamento/12">
        Dezembro
    </a>
    









    {{-- <div class="ContainerComPaddingPadrao">
        <h1>Faturamento</h1>
        <div class="containerGrafico">
            <canvas class="line-chart"></canvas>
        </div> 
    </div> --}}
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    var arrDiasValor = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]

   

  
    /*  let janeiro = {
        valores : separaPedidosPorDiaValor(querys.janeiro),
        pedidos : separaPedidosPorDia(querys.janeiro)
    } 
    var fevereiro = {
        valores : separaPedidosPorDiaValor(querys.fevereiro),
        pedidos : separaPedidosPorDia(querys.fevereiro)
    }
    var marco = {
        valores : separaPedidosPorDiaValor(querys.marco),
        pedidos : separaPedidosPorDia(querys.marco)
    } */
   /*  let abril = {
        valores : separaPedidosPorDiaValor(querys.abril),
        pedidos : separaPedidosPorDia(querys.abril)
    }
    let maio = {
        valores : separaPedidosPorDiaValor(querys.maio),
        pedidos : separaPedidosPorDia(querys.maio)
    }
    let junho = {
        valores : separaPedidosPorDiaValor(querys.junho),
        pedidos : separaPedidosPorDia(querys.junho)
    }
    let julho = {
        valores : separaPedidosPorDiaValor(querys.julho),
        pedidos : separaPedidosPorDia(querys.julho)
    }
    let agosto = {
        valores : separaPedidosPorDiaValor(querys.agosto),
        pedidos : separaPedidosPorDia(querys.agosto)
    }
    let setembro = {
        valores : separaPedidosPorDiaValor(querys.setembro),
        pedidos : separaPedidosPorDia(querys.setembro)
    }
    let outubro = {
        valores : separaPedidosPorDiaValor(querys.outubro),
        pedidos : separaPedidosPorDia(querys.outubro)
    }
    let novembro = {
        valores : separaPedidosPorDiaValor(querys.novembro),
        pedidos : separaPedidosPorDia(querys.novembro)
    }
    let dezembro = {
        valores : separaPedidosPorDiaValor(querys.dezembro),
        pedidos : separaPedidosPorDia(querys.dezembro)
    } */
    
   /*  console.log('jan',janeiro)
    console.log('fev',fevereiro)
    console.log('mar',marco)

    function separaPedidosPorDia(mes, nomeMes){
        let arrDias = arrDiasAuxiliar.arrParaDados
        
        let pedidosPorDia = mes.query.reduce((acc, curr)=>{
                let indiceDia = getDiaIndice(curr.created_at)
                acc[indiceDia].push(curr)
                return acc
        }, arrDias)
        
        return pedidosPorDia
    }
    function separaPedidosPorDiaValor(mes, nomeMes){
        let arrValor = arrDiasValor

        let pedidosPorDiaValor = mes.query.reduce((acc, curr)=>{
            let dia = getDiaIndice(curr.created_at)
            let valorPrato = getValorPrato(curr.prato_id)
            acc[dia] += valorPrato
            return acc
        }, arrValor)
        
        return pedidosPorDiaValor
    }

    


    function getValorPrato(id){
        let prato = pratos.find( prato => prato.id == id )

        return prato.preco
    }

    function getDiaIndice(data){
        let dia    = data.split('T')[0].split('-')[2]
        let indice = dia < 10 ? dia.split('')[1] : dia

        return parseInt(indice - 1)
    } */

    

    
    
    

    

    

  /*   let chartGraph = new Chart( ctx, {
        type: 'line',
        data: {
            labels : arrDias.dias,
            datasets : [
                {
                    label : 'Janeiro',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Fevereiro',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Março',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Abril',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Maio',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Junho',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Julho',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Agosto',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Setembro',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Outubro',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Novembro',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                },
                {
                    label : 'Dezembro',
                    data : ,
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                }

        ]
        }
    })   */

</script>


<script src="/js/faturamento.js"></script>

@endsection