
@extends('layouts.main')

@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="ContainerComPaddingPadrao">
    <h1>{{$nomeMes}}</h1>
    <div class="dashboardBlockLinha">
        <div class="infoDashboard">
            <div class="innerInfoDashboard">
                <span class="infoDashboardValue" id="lucroTotal"></span>
                <span class="infoDashboardTittle">Lucro total</span> 
            </div>
        </div>
        <div class="infoDashboard">
            <div class="innerInfoDashboard">
                <span class="infoDashboardValue" id="NumeroDePedidos">{{count($pedidos)}}</span>
                <span class="infoDashboardTittle">Numero de pedidos</span> 
            </div>
            
        </div>
        <div class="infoDashboard">
            <div class="innerInfoDashboard">
                <span class="infoDashboardValue" id="NovosClientes">{{$qtdNovosClientes}}</span>
                <span class="infoDashboardTittle">Clientes cadastrados</span> 
            </div>
            
        </div>
        <div class="infoDashboard">
            <div class="innerInfoDashboard">
                <span class="infoDashboardValue" id="Entregues"></span>
                <span class="infoDashboardTittle">Pedidos entregues</span> 
            </div>
            
        </div>
        <div class="infoDashboard">
            <div class="innerInfoDashboard">
                <span class="infoDashboardValue" id="Cancelados"></span>
                <span class="infoDashboardTittle">Pedidos cancelados</span> 
            </div>
            
        </div>
    </div>
    <div class='graficosContainer'>
        <div class="containerGrafico">
            <canvas class="line-chart"></canvas>
        </div> 
        <div class="containerGrafico">
            <canvas class="line-chart2"></canvas>
        </div> 
    </div>
    <div class='graficosContainer'>
        <div class="containerGraficoPie">
            <canvas class="line-chart3"></canvas>
        </div> 
        <div id="tabelaDashboard">
            <h4>Clientes com mais pedidos registrados</h4>
            <table class="table table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quatidade de pedidos</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($TopCincoclientes as$cliente)
                  <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$cliente->Nome}}</td>
                    <td>{{$cliente->totPedidos}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>   
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/analise.js"></script>
<script>
    var query       = {!! json_encode($pedidos) !!}
    var arrAuxiliar = {!! json_encode($arrAuxiliar) !!}
    var nomeMes     = {!! json_encode($nomeMes) !!}
    var pratos      = {!! json_encode($pratos) !!}

    let pedidosSeparados            = separaPedidos(query)
    let quantidadeDePedidosPorPrato = quantidadeDeVendasPorPrato(query)
    let pedidosSeparadosPorDia      = separaPedidosPorDia(query)
    let numeroDePedidosPorDia       = retornaArrayComNumeroDePedidosPorDia(pedidosSeparadosPorDia)
    let valorGanhoPorDia            = getValorGanhoPorDia(pedidosSeparadosPorDia)

    const LucroMensal = totalLucro()
    const entregues   = pedidosSeparados.entregues
    const cancelados  = pedidosSeparados.cancelados

    let lucroDiv = document.getElementById('lucroTotal')
    lucroDiv.innerText = LucroMensal

    let novoClientes = document.getElementById('NovosClientes')


    let EntreguesDiv = document.getElementById('Entregues')
        EntreguesDiv.innerText = entregues

    let CanceladosDiv = document.getElementById('Cancelados')
        CanceladosDiv.innerText = cancelados

    
     

    /*GRAFICO */
    let ctx = document.getElementsByClassName('line-chart')
    
    let chartGraph = new Chart( ctx, {
        type: 'bar',
        data: {
            labels : arrAuxiliar.dias,
            datasets : [
                {
                    label : `Número de pedidos por dia de ${nomeMes}`,
                    data : numeroDePedidosPorDia,
                    borderWidth : 2,
                    borderColor : 'white',
                    backgroundColor : '#073f5a',
                    width: '60%',
                    display:'false',
                    heigth: 'fit-content'
                }
            ]
        }
    })

    let ctxValores = document.getElementsByClassName('line-chart2')
    
    let chartGraphValores = new Chart( ctxValores, {
        type: 'line',
        data: {
            labels : arrAuxiliar.dias,
            datasets : [
                {
                    label : `Valor arrecadado por dia de ${nomeMes}`,
                    data : valorGanhoPorDia,
                    borderWidth : 2,
                    borderColor : 'rgb(92, 161, 124)',
                    backgroundColor : '#8cb27f',
                    width: '60%',
                    heigth: 'fit-content'
                }
            ]
        }
    })
    let ctxPratos = document.getElementsByClassName('line-chart3')

    let chartGraphPratos = new Chart( ctxPratos, {
        type: 'bar',
        data: {
            labels : Object.keys(quantidadeDePedidosPorPrato),
            datasets : [
                {
                    label : `Relação de pedidos por prato ${nomeMes}`,
                    data : Object.values(quantidadeDePedidosPorPrato),
                    borderWidth : 1,
                    borderColor : ['transparent'],
                    /*backgroundColor : ['#5700C2','#5500BF','#180036','#1E0042','#170033','#200047','#0E001F']*/
                    backgroundColor :['#211e19','#073f5a','#b1d7a8','#55725c','#eae8ed','#063045','#D0CDD4'],
                    width: '60%',
                    heigth: '300px'
                }
            ]
        }
    })
</script>

@endsection