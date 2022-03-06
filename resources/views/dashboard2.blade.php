@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div id="DashboardMain">
    <div class="left">
        <div id="leftTop">
            <div id="leftTittle">
                <h1>Monitore o seu sistema em tempo real</h1>
                <p>
                    {{$data['day']}} de {{$data['mes']}} de {{$data['year']}}
                     <ion-icon id="IconeCalendario" name="calendar-number-outline"></ion-icon>
                </p>
            </div>
            <div id="leftSearch">
                <div class="leftSearchContainer" id="searchContainer">
                    <div id="inputSearch">
                        <div class="input-group rounded">
                            <input type="search" class="searchInput form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            
                          </div>
                    </div>
                </div>
                <div class="leftSearchContainer " id="dataDia">
                    <div class="leftOption" name='relatorio'>
                        <span class="selected"><ion-icon class="iconOption" name="document-text-outline"></ion-icon></span>
                    </div>
                    <div class="leftOption" name='pedidos'>
                        <span><ion-icon class="iconOption" name="list-outline"></ion-icon></span>
                    </div>
                    <div class="leftOption" name='alguma'>
                        <span><ion-icon class="iconOption" name="musical-notes-outline"></ion-icon></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="divOptionContainer">
            <div class="divOption showDiv" name='relatorio' >
                <div id="salesReport">
                    <div class="infoDashboard2">
                        <div class="innerInfoDashboard">
                            <span class="infoDashboardValue" id="lucroTotal">R$ </span>
                            <span class="infoDashboardTittle">Lucro de hoje</span> 
                        </div>
                    </div>
                    <div class="infoDashboard2">
                        <div class="innerInfoDashboard">
                            <span class="infoDashboardValue" id="totPedidos">{{count($pedidos)}}</span>
                            <span class="infoDashboardTittle">Total de pedidos</span> 
                        </div>
                    </div>
                    
                    <div class="infoDashboard2">
                        <div class="innerInfoDashboard">
                            <span class="infoDashboardValue" id="Entregue">{{count($entregues)}}</span>
                            <span class="infoDashboardTittle">Pedidos entregues</span> 
                        </div>
                    </div>
                    <div class="infoDashboard2">
                        <div class="innerInfoDashboard">
                            <span class="infoDashboardValue" id="Rota de entrega">{{count($rotaDeEntrega)}}</span>
                            <span class="infoDashboardTittle">Pedidos em rota de entrega</span> 
                        </div>
                    </div>
                    <div class="infoDashboard2">
                        <div class="innerInfoDashboard">
                            <span class="infoDashboardValue" id="SendoPreparadso">{{count($sendoPreparados)}}</span>
                            <span class="infoDashboardTittle">Cozinhando</span> 
                        </div>
                    </div>
                    <div class="infoDashboard2">
                        <div class="innerInfoDashboard">
                            <span class="infoDashboardValue" id="Cancelados">{{count($cancelados)}}</span>
                            <span class="infoDashboardTittle">Pedidos cancelados</span> 
                        </div>
                    </div>
                </div>
                                    {{-- qtd pedidos de hoje
                    lucro 
                    gasto 
                    entrgues
                    pedidos sendo rpeparados
                    pedidos em rota de entrega
                    pedidos cancelados  --}}

                
            </div>
            <div class="divOption hiddenDiv" id="pedidos" name='pedidos'>
                <h3>Pedidos de hoje</h3>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Contato</th>
                        <th scope="col">Prato</th>
                        <th scope="col">Endereco</th>
                        <th scope="col" class="pointer" id="Status">Status</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Hora</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                        
                        <tr class="pedidoLinha" id="{{$pedido->id}}">
                            <th>{{$pedido->cliente->Nome}}</th>
                            <td>{{$pedido->cliente->Cel}}</td>
                            <td>{{$pedido->prato['Nome prato']}}</td>
                            <td>{{$pedido->Endereco->Rua}},{{$pedido->Endereco->Numero}} - {{$pedido->Endereco->Bairro}}</td>
                            @php
                                $status = $pedido->status;
                                if($status == 'Entregue') $class = 'colorGreen1';
                                if($status == 'Saiu para entrega') $class = 'colorYellow';
                                if($status == 'Preparando pedido') $class = 'colorGreenDark';
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
                    </tbody>
                  </table>
            </div>
            <div class="divOption hiddenDiv" name='alguma'>
                Alguma opção
            </div>
        </div>
        
    </div>
    <div class="rigth">
        @if ($prato)  
            <div id="pratoDoDia">    
                <h1>Prato do dia</h1>
                <ul>
                    <li><span>Nome do prato</span>: {{$prato['Nome prato']}}</li>
                    <li><span>Ingredientes</span>: {{$prato->Ingredientes}}</li>
                    <li><span>Descrição</span>: {{$prato->descricao}} </li>
                    <li><span>Preço</span>: R$ {{$prato->preco}} </li>
                </ul>
                <a  class="btn " id="verdeEscuro" href="/prato/updateForm/{{$prato->id}}">Editar</a>
            </div>      
                  
        @else
            <div id="pratoDoDia">    
                <h1 style="text-align: center">Nenhum prato registrado hoje</h1>
                <ul>
                    <li><span>Nome do prato</span>: </li>
                    <li><span>Ingredientes</span>: </li>
                    <li><span>Descrição</span>:  </li>
                    <li><span>Preço</span>:  </li>
                </ul>
                <a href="/prato" class="btn btn-dark" >Registrar prato do dia</a>
            </div>
            
        @endif
        </div>
    </div>
    
    
  
<script src="/js/dashboard.js"></script>
<script>
    let pratos = {!! json_encode($pratos) !!}
    let pedidos = {!! json_encode($pedidos) !!}

    let optionsDashboard = [... document.getElementById('dataDia').getElementsByTagName('span')]
        console.log(optionsDashboard)
        optionsDashboard.forEach(opt => {
            opt.addEventListener('click', handleDashboard)
        });

    function getLucro(){
        let lucro = pedidos.reduce( (acc,pedido) => {
            let prato = getPrato(pedido.prato_id)
            if(pedido.status == 'Entregue')acc += prato.preco 
            return acc
        },0)

        return lucro.toFixed(2)
    }

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
