@extends('pdf.main')
@section('content')
<h1>Pedidos entregues de {{$nomeMes}}</h1>
<div class="numeros">
  <li>Lucro total: R$ {{number_format($lucro,2)}} </li>
  <li>Clientes cadastrados: {{$qtdNovosClientes}}</li>
  <li>Numero de pedidos: {{count($pedidos)}} </li>
  <li>Pedidos entregues: {{$entregues}}</li>
  <li>Pedidos cancelados: {{$cancelados}}</li>
</div>
<h1>Clientes com mais pedidos</h1>
<table>
  <tr>
    <th>Nome</th>
    <th>Pedidos</th>
  </tr>
  @foreach($TopCincoclientes as $cliente)
  <tr>  
    <th>{{$cliente->Nome}}</th>
    <th>{{count($cliente->pedidos)}}</th>
  </tr>
  @endforeach
</table>



@endsection
