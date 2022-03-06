@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container centerFlex flexColumn">
  <form action="/Clientes" method="get" class="filter flexColumn border">
    @csrf
    <h1>Clientes</h1>
    <div class="filter">
      <div class="filterInputCard ">
        <label for="Nome">
          <input class="inputCustom" placeholder="Nome do cliente" name="Nome" type="text">
        </label>
        <label for="email">
          <input class="inputCustom" placeholder="email" name="email"  type="email">
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
          <label for="CPF">
            <input class="inputCustom" placeholder="CPF" name='CPF' type="text">
          </label>
      </div>
      
      <div class="filterInputCard"">
        <label for="cel">
          <input class="inputCustom" placeholder="Cel" name="cel"  type="text">
        </label>
        <div  style="padding: 10px">
          <h5 style="font-weight: bolder">Criado</h5>
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
  <span>Total de clientes: {{$totCliente}}</span>
  <div class="table-responsive border">
    <table class="table tabela" id="tabela">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            <th scope="col">Cel</th>
            <th scope="col">Endereco</th>
            <th scope="col">Pedidos registrados</th>
            <th scope="col">Criado em</th>
            <th scope="col">alterado em</th>
            <th scope="col" >Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($query as $cliente)
                <tr>
                    <th scope="row">{{$cliente->id}}</th>
                    <td>{{$cliente->Nome}}</td>
                    <td>{{$cliente->Email}}</td>
                    <td>{{$cliente->CPF}}</td>
                    <td>{{$cliente->Cel}}</td>
                    <td>{{$cliente->enderecos[0]->Rua}} - {{$cliente->enderecos[0]->Numero}},{{$cliente->enderecos[0]->Bairro}}</td>
                    <td>{{count($cliente->pedidos)}}</td>
                    <td>{{$cliente->created_at}}</td>
                    <td>{{$cliente->updated_at}}</td>
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
    </div>
      {{$query->links()}}
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