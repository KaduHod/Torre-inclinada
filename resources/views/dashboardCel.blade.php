@extends('layouts.mainCelphone')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="section">
<div class="Card BCbranco sombra borderRadius" id="pratoDoDia">
    @if($prato)
    <h1 class="CardTittle">
        Prato do dia
    </h1>
    <ul class="infosPrato">
        
        <li><span>Nome do prato: </span>{{$prato['Nome prato']}}</li>
        <li><span>Ingredientes: </span> {{$prato->Ingredientes}}</li>
        <li><span>Descrição: </span> {{$prato->descricao}}</li>
        <li><span>Preço: </span> {{$prato->preco}}</li>
        
    </ul>
    <a class="btn btn-dark" href="/prato">EDITAR</a>
    @else
    <h1 class="CardTittle">
        Nenhum prato registrado
    </h1>
    <a class="btn btn-dark" href="/prato">CRIAR</a>
    @endif
</div>
</div>
<div class="section borderIOS">
    <div class="CardInfo ">
        {{--Opção estilo IOS--}}
        <div class="icon">
            <ion-icon name="information-circle-outline"></ion-icon>
        </div>
        <div class="CardInfoTittle">
            Relatório de hoje
        </div>
        <div class="icon showOptions">
            <ion-icon name="caret-down-outline"></ion-icon>
        </div>
    </div>

    <div class="CardInfoContent growUp ">
        <div class="ContainerCardPequeno">
            <div class='CardPequeno borderRadius '>
                <div class="ContainerIconValue">
                    <ion-icon name="cash-outline" style="color: green" class="CardPequenoIcon">
                        
                    </ion-icon>
                    <div id="Lucro" class="CardPequenoValue">
        
                    </div>
                </div>
                
                <div class="CardPequenoTittle">
                    Faturamento
                </div>
            </div>
            <div class='CardPequeno borderRadius '>
                <div class="ContainerIconValue">
                    <ion-icon name="bag-handle-outline" style="color: rgb(99, 99, 37)" class="CardPequenoIcon">
                        
                    </ion-icon>
                    <div  class="CardPequenoValue">
                        {{count($pedidos)}}
                    </div>
                </div>
                
                <div class="CardPequenoTittle">
                    Total de pedidos
                </div>
            </div>
            <div class='CardPequeno borderRadius '>
                <div class="ContainerIconValue">
                    <ion-icon name="checkmark-done-outline" style="color: rgb(67, 112, 63)" class="CardPequenoIcon">
                        
                    </ion-icon>
                    <div id="Entregue"  class="CardPequenoValue">
                        
                    </div>
                </div>
                
                <div class="CardPequenoTittle">
                    Entregues
                </div>
            </div>
            <div class='CardPequeno borderRadius '>
                <div class="ContainerIconValue">
                    <ion-icon name="alarm-outline" style="color: rgb(95, 95, 95)" class="CardPequenoIcon">
                        
                    </ion-icon>
                    <div id="PreparandoPedido"  class="CardPequenoValue">
                        
                    </div>
                </div>
                
                <div class="CardPequenoTittle">
                    Preparando
                </div>
            </div>
            <div class='CardPequeno borderRadius '>
                <div class="ContainerIconValue">
                    <ion-icon name="bicycle-outline" style="color: rgb(132, 145, 16)" class="CardPequenoIcon">
                        
                    </ion-icon>
                    <div id="SaiuParaEntrega"  class="CardPequenoValue">
                        
                    </div>
                </div>
                
                <div class="CardPequenoTittle">
                    Em rota
                </div>
            </div>
            <div class='CardPequeno borderRadius '>
                <div class="ContainerIconValue">
                    <ion-icon name="trash-outline" style="color: rgb(131, 37, 37)" class="CardPequenoIcon">
                        
                    </ion-icon>
                    <div id="Cancelado"  class="CardPequenoValue">
                        
                    </div>
                </div>
                
                <div class="CardPequenoTittle">
                    Cancelados
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="section borderIOS">
    <div class="CardInfo ">
        {{--Opção estilo IOS--}}{{--
        <div class="icon">
            <ion-icon name="newspaper-outline"></ion-icon>
        </div>
        <div class="CardInfoTittle">
            Pedidos
        </div>
        <div class="icon showOptions">
            <ion-icon name="caret-down-outline"></ion-icon>
        </div>
    </div>
    <div class="CardInfoContent growUp">

    </div>
    
</div> --}}

<div class="section borderIOS">
    <div class="CardInfo ">
        {{--Opção estilo IOS--}}
        <div class="icon">
            <ion-icon name="document-text-outline"></ion-icon>
        </div>
        <div class="CardInfoTittle">
            Pedidos de hoje
        </div>
        <div class="icon showOptions ">
            <ion-icon name="caret-down-outline"></ion-icon>
        </div>
    </div>
    <div class="CardInfoContent growUp">
        <table>
            <tr>
                <th>Cliente</th>
                <th>Prato</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Preço</th>
                <th>Hora pedido</th>
            </tr>
            @forEach($pedidos as $pedido)
            
            <tr>
                <th><a href="Pedidos/editar-status/{{$pedido->id}}">{{$pedido->cliente->Nome}}</a></th>
                <td>{{$pedido->cliente->Cel}}</td>
                <td>{{$pedido->prato['Nome prato']}}</td>
                <td>{{$pedido->Endereco->Rua}},{{$pedido->Endereco->Numero}} - {{$pedido->Endereco->Bairro}}</td>
                @php
                    $status = $pedido->status;
                        if($status == 'Entregue') $class = 'colorGreen';
                        if($status == 'Saiu para entrega') $class = 'colorYellow';
                        if($status == 'Preparando pedido') $class = 'colorYellow';
                        if($status == 'Cancelado') $class = 'colorRed';      
                @endphp
    
                <td class="{{$class}} status">{{$pedido->status}}</td>
                <td>R$ {{$pedido->prato->preco}}</td>
                @php
                    $horaArr = $pedido->created_at->toArray();
                    if($horaArr['minute'] < 10) $horaArr['minute'] = '0'.$horaArr['minute'];         
                        $hora = $horaArr['hour'] . ':' . $horaArr['minute'];
                @endphp
                <td>{{$hora}}</td>
            </tr>
            
            
            @endforeach
        </table>
    </div>
</div>
    
  
<script src="/js/dashboard.js"></script>
<script>

    let optionsSeta = [... document.getElementsByClassName('showOptions')]
        optionsSeta.forEach(seta => {
            seta.addEventListener('click',hadleOptionSeta)
        });


    function hadleOptionSeta(){
        let pai = this.parentNode.parentNode
        let divContent = pai.getElementsByClassName('CardInfoContent')[0]
        hadleContent(divContent)
    }

    function hadleContent(div){
        let classes = [... div.classList]

        if( classes.length == 1 ) return growDown(div)
        
        return classes.indexOf('growDown') > -1 ? growUp(div) : growDown(div)
        
    }

    function growDown(div){
        let classes = [... div.classList]

        giraSetaCima(div)

        let verificaSeTiraGrowUp = classes.indexOf('growUp') > -1 ? div.classList.remove('growUp') : false
        div.classList.add('growDown')
    }

    function growUp(div){
        let classes = [... div.classList]

        let verificaSeTiraGrowDown = classes.indexOf('growDown') > -1 ? div.classList.remove('growDown') : false

        giraSetaBaixo(div)
        div.classList.add('growUp')
    }

    function giraSetaBaixo(div){
        let seta = div.previousElementSibling.lastElementChild
        seta.classList.remove('setaParaCima')
        
    }

    function giraSetaCima(div){
        let seta = div.previousElementSibling.lastElementChild
        seta.classList.add('setaParaCima')
    }

    

    let pratos = {!! json_encode($pratos) !!}
    let pedidos = {!! json_encode($pedidos) !!}


    function separaPedidos(){
        let pedidosSeparadosPorStatus = pedidos.reduce((acc,curr)=>{
            acc[curr.status] ++
            return acc
        }, {
            'Entregue': 0,
            'Preparando pedido': 0,
            'Cancelado': 0,
            'Saiu para entrega': 0
        })
        return pedidosSeparadosPorStatus
    }
    

    function botaValoresPorStatus(){
        let pedidosSeparadosPorStatus = separaPedidos()

        let Cancelado = document.getElementById('Cancelado')
        let SaiuParaEntrega = document.getElementById('SaiuParaEntrega')
        let Entregue = document.getElementById('Entregue')
        let PreparandoPedido = document.getElementById('PreparandoPedido')

        Cancelado.innerText = pedidosSeparadosPorStatus['Cancelado']
        SaiuParaEntrega.innerText = pedidosSeparadosPorStatus['Saiu para entrega']
        Entregue.innerText = pedidosSeparadosPorStatus['Entregue']
        PreparandoPedido.innerText = pedidosSeparadosPorStatus['Preparando pedido']
    }
    botaValoresPorStatus()

    function getLucro(){
        let lucro = pedidos.reduce( (acc,pedido) => {
            let prato = getPrato(pedido.prato_id)
            if(pedido.status == 'Entregue')acc += prato.preco 
            return acc
        },0)

        return lucro.toFixed(2)
    }

    let lucroLi = document.getElementById('Lucro')
        lucroLi.innerText = "R$ " + getLucro()







//SCRIPTS DO DASHBOARD ANTIGO
    

    let optionsDashboard = [... document.getElementById('dataDia').getElementsByTagName('span')]
        console.log(optionsDashboard)
        optionsDashboard.forEach(opt => {
            opt.addEventListener('click', handleDashboard)
        });

    

let lucroSpan = document.getElementById('lucroTotal')
    lucroSpan.innerText += ` ${getLucro()}`

    
    let linhasPedidos = [... document.getElementsByClassName('pedidoLinha')]
    linhasPedidos.forEach( linha => {
        linha.addEventListener('click',redirectToPedido,false)
    })


let status = document.getElementById('Status')
    status.addEventListener('click',hadleStatus)
let controlaStatus = {
    arr:['todos','Cancelado','Entregue','Preparando pedido','Saiu para entrega'],
    current: 'todos'
}; 
</script>

    
@endsection
