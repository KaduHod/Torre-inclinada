@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container centerFlex flexColumn">
    
    <table class="table">
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
        <tbody>
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
                       
                    </td>
              </tr>
            @endforeach
        </tbody>
      </table>
      <a href="/Pedidos/create"><div class="add"></div></a>
      <div class="notificacao"> 
        <div class="flexNotificacao" >
          <h3>Excluir pedido</h3>
          <div class="botoesLado_a_lado">
            <a class="btn btn-danger" href='' id="excluir">Excluir</a><button id="fecharNotificacao" class='btn btn-dark'>cancelar</button>
          </div>
        </div>
      </div>
</div>
<script src="/js/confirmacaoExcluirPedido.js"></script>

@endsection