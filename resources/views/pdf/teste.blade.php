@extends('pdf.main')
@section('content')
<h1>Pedidos entregues de janeiro</h1>
    <table>
        <tr>
          <th>Cliente</th>
          <th>Endereço</th>
          <th>valor</th>
          <th>data</th>
        </tr>
        @foreach($pedidos as $pedido)
        <tr>
          <td>{{$pedido->cliente->Nome}}</td>
          <td>{{$pedido->endereco->Rua}},{{$pedido->endereco->Numero}} - {{$pedido->endereco->Bairro}}</td>
          <td>$ {{$pedido->prato->preco}}</td>
          <td>
              @php
                  $data = $pedido->created_at->toArray();
              @endphp
              {{$data['day']}}/{{$data['month']}}/{{$data['year']}}
          </td>
        </tr>
        @endforeach
        
      </table>
@endsection
