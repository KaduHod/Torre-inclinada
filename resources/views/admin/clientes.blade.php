@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container centerFlex flexColumn">
    
    <table class="table tabela" id="tabela">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            <th scope="col">Cel</th>
            <th scope="col">Pedidos registrados</th>
            <th scope="col" >Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <th scope="row">{{$cliente->id}}</th>
                    <td>{{$cliente->Nome}}</td>
                    <td>{{$cliente->Email}}</td>
                    <td>{{$cliente->CPF}}</td>
                    <td>{{$cliente->Cel}}</td>
                    <td>{{count($cliente->pedidos)}}</td>
                    <td>
                      <a href="/cliente/edit/{{$cliente->id}}" class="colorGreen" >
                        <ion-icon class="iconAdmin "  name="create-outline"></ion-icon>
                      </a>
                      <ion-icon class="iconAdmin colorRed"  id="{{$cliente->id}}" name="trash-outline"></ion-icon>
                    </td>
              </tr>
            @endforeach
        </tbody>
      </table>
      <a href="/Pedidos/create"><div class="add"></div></a>
      <div class="notificacao"> 
        <div class="flexNotificacao" >
          <h3>Excluir cliente</h3>
          <div class="botoesLado_a_lado">
            <a class="btn btn-danger" href='' id="excluir">Excluir</a><button id="fecharNotificacao" class='btn btn-dark'>cancelar</button>
          </div>
        </div>
      </div>
</div>
<script src="/js/confirmacaoExcluirPedido.js"></script>

@endsection