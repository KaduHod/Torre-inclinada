@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container centerFlex flexColumn">
  <div class="table-responsive border">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Ingredientes</th>
            <th scope="col">Preço</th>
            <th scope="col">Pedidos registrados</th>
            <th scope="col">Data</th>
            <th scope="col" >Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($pratos as $prato)
                <tr>
                    <th scope="row">{{$prato->id}}</th>
                    <td>{{$prato['Nome prato']}}</td>
                    <td>{{$prato->Ingredientes}}</td>
                    <td>{{$prato->preco}}</td>
                    <td>{{count($prato->pedido)}}</td>
                    <td>{{$prato->created_at}}</td>
                    <td>
                      <a href="/prato/updateForm/{{$prato->id}}" style="color:rgb(102, 224, 102)">
                        <ion-icon class="iconAdmin"  name="create-outline"></ion-icon>
                      </a>
                      <ion-icon class="iconAdmin colorRed" style="color:rgb(214, 85, 85)" id="{{$prato->id}}" name="trash-outline"></ion-icon>
                     
                    </td>
              </tr>
            @endforeach
        </tbody>
      </table>
    </div>
      <a href="/prato"><div class="add"></div></a>
      <div class="notificacao2"> 
        <div class="flexNotificacao" >
          <h3>Excluir prato</h3>
          <div class="botoesLado_a_lado">
            <a class="btn btn-danger" href='' id="excluir">Excluir</a><button id="fecharNotificacao" class='btn btn-dark'>cancelar</button>
          </div>
        </div>
      </div>
</div>
<script src="/js/confirmacaoExcluirPedido.js"></script>

@endsection