@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
    Pedidos sendo preparados: {{$pedidosSendoPeparados}} <br>
    Pedidos na entrega: {{$pedidosSendoEntregues}}<br>
    Pedidos Entregues: {{$pedidosEntregues}}<br>
    Pedidos de hoje: {{$pedidoDeHoje}}<br>
@endsection
