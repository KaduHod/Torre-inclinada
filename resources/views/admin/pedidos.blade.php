@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container centerFlex flexColumn">
  
  <form action="/Pedidos" method="get" class="filter flexColumn border">
    @csrf
    <h1>Pedidos</h1>
    <div class="filter">
      <div class="filterInputCard ">
        <label for="Nome">
          <input class="inputCustom" placeholder="Nome do cliente" name="Nome" type="text">
        </label>
        <label for="prato">
          <input class="inputCustom" placeholder="Nome do prato" name="prato"  type="text">
        </label>
          <label for="enderecoRua">
            <input class="inputCustom" placeholder="Rua" name="enderecoRua" type="text">
          </label>
          <label for="enderecoNumero">
            <input class="inputCustom" placeholder="Número" name="enderecoNumero" type="text">
          </label>
          <label for="enderecoBairro">
            <input class="inputCustom" placeholder="Bairro" name="enderecoBairro" type="text">
          </label>
          <label for="CEP">
            <input class="inputCustom" placeholder="CEP" name='Cep' type="text">
          </label>
      </div>
      
      <div class="filterInputCard"">
        <label for="status">
          <input class="inputCustom" placeholder="Status" name="status"  type="text">
        </label>
        <label for="Funcionario">
          <input class="inputCustom" placeholder="Funcionario" name="Funcionario" type="text">
        </label>
        <div  style="padding: 10px">
          <h5 style="font-weight: bolder">Selecionar entre datas</h5>
          <label  for="DataPedidoInicio">
            de
            <input class="inputCustom" placeholder="Data de criação do pedido" name='DataPedidoInicio' type="date">
          </label>
          <label  for="DataPedidoFim">
            até
            <input class="inputCustom" placeholder="Data de criação do pedido" name='DataPedidoFim' type="date">
          </label>
        </div>
        <div style="padding: 10px">
          <h5 style="font-weight: bolder">Alterado em</h5>
          <label for="Alterado">
            <input class="inputCustom" placeholder="Alterado pela ultima vez" name='Alterado' type="date">
          </label>
        </div>
        
        

      </div>
    </div>
    <button class="btn btn-dark">Pesquisar</button>
  </form>
  <span>Total de pedidos: {{$totPedidos}}</span>
  @if($totPedidos == $TotalDeRegistrosDaPesquisa)
    <span>Pesquisa não retornou nenhum registro!</span>
  @else
    <span>Total de registros da pesquisa: {{$TotalDeRegistrosDaPesquisa}}</span> 
  @endif
  
    <div class="table-responsive border">
      <table class="table " >
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Cliente</th>
            <th scope="col">prato</th>
            <th scope="col">Endereço</th>
            <th scope="col">Status</th>
            <th scope="col">Funcionario</th>
            <th scope="col">Data de criação</th>
            <th scope="col">Alterado em</th>
            <th scope="col" >Ações</th>
          </tr>
        </thead>
        <tbody >
          @foreach($pedidos as $pedido)
            <tr>
              <th scope="row">{{$pedido->id}}</th>
              <td>{{$pedido->cliente->Nome}}</td>
              <td>{{$pedido->prato['Nome prato']}}</td>
              <td>{{$pedido->endereco->Rua}} - {{$pedido->endereco->Numero}}, {{$pedido->endereco->Bairro}} </td>
              <td>{{$pedido->status}}</td>
              <td>{{$pedido->funcionario}}</td>
              <td>{{$pedido->created_at}}</td>
              <td>{{$pedido->updated_at}}</td>
              <td>
                <a href="/Pedidos/edit/{{$pedido->id}}" style="color:rgb(102, 224, 102)">
                  <ion-icon class="iconAdmin"  name="create-outline"></ion-icon>
                </a>
                <ion-icon class="iconAdmin colorRed" style="color:rgb(214, 85, 85)" id="{{$pedido->id}}" name="trash-outline"></ion-icon> 
               {{--  @php
                 dd($pedido->status =='Preparando pedido' && $pedido->status !== 'cancelado' )   ;
                @endphp --}}
                @if($pedido->status == 'Preparando pedido' && $pedido->status !== 'cancelado')
                  <a href="/Pedidos/editar-status/{{$pedido->id}}"><ion-icon class="iconAdmin Colorgreen" name="hammer-outline"></ion-icon></a>  
                @endif
                
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
      
    <div class="notificacao"> 
      <div class="flexNotificacao" >
        <h3>Excluir pedido</h3>
        <div class="botoesLado_a_lado">
          <a class="btn btn-danger" href='' id="excluir">Excluir</a><button id="fecharNotificacao" class='btn btn-dark'>cancelar</button>
        </div>
      </div>
    </div>
    
    <a href="/Pedidos/create"><div class="add"></div></a>
      {{$pedidos->links()}}


</div>
<script src="/js/confirmacaoExcluirPedido.js"></script>

@endsection