@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="ContainerComPaddingPadrao">
    Adicionar grafico com faturamento por dia - DEU CERTO CARAIO <br>
    Adiconar grafico com faturamento por mês <br>
    Adicionar grafico com pratos mais pedidos <br>
    Adicionar grafico com preco mais Pedido <br>
    Adicionar grafico com clientes clientes com mais pedidos
    <div class="containerGrafico">
        
        <canvas class="line-chart"></canvas>
    </div>
    
    
    
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let diasSeparadosPorMes = {!! json_encode($pedidos_separados_por_dia)!!}
    console.log(diasSeparadosPorMes)

    let arrComTotPreco = diasSeparadosPorMes.map(dia => {
        let soma = dia.reduce((soma, curr)=>{
            return soma + curr
        }, 0)
        return soma
    })

    console.log(arrComTotPreco)
    let ctx = document.getElementsByClassName('line-chart')
    
    // type, data e options
    let chartGraph = new Chart( ctx, {
        type: 'line',
        data: {
            labels : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'],
            datasets : [
                {
                    label : 'Faturamento por dia no mês de fevereiro',
                    data : [
                        arrComTotPreco[0],
                        arrComTotPreco[1],
                        arrComTotPreco[2],
                        arrComTotPreco[3],
                        arrComTotPreco[4],
                        arrComTotPreco[5],
                        arrComTotPreco[6],
                        arrComTotPreco[7],
                        arrComTotPreco[8],
                        arrComTotPreco[9],
                        arrComTotPreco[10],
                        arrComTotPreco[11],
                        arrComTotPreco[12],
                        arrComTotPreco[13],
                        arrComTotPreco[14],
                        arrComTotPreco[15],
                        arrComTotPreco[16],
                        arrComTotPreco[17],
                        arrComTotPreco[18],
                        arrComTotPreco[19],
                        arrComTotPreco[20],
                        arrComTotPreco[21],
                        arrComTotPreco[22],
                        arrComTotPreco[23],
                        arrComTotPreco[24],
                        arrComTotPreco[25],
                        arrComTotPreco[26],
                        arrComTotPreco[27],
                        arrComTotPreco[28],
                    ],
                    borderWidth : 2,
                    borderColor : 'red',
                    backgroundColor : 'transparent',
                    width: '60%',
                    heigth: 'fit-content'
                }
        ]
        }
    }) 
</script>
@endsection