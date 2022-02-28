@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div id="DashboardMain">
    @if ($prato)
    <div id="pratoDoDia">
        <h1>Prato do dia</h1>
        <ul>
            <li><span>Nome do prato</span>: {{$prato['Nome prato']}}</li>
            <li><span>Ingredientes</span>: {{$prato->Ingredientes}}</li>
            <li><span>Descrição</span>: {{$prato->descricao}} </li>
            <li><span>Preço</span>: {{$prato->preco}} </li>
        </ul>
        <a  class="btn btn-dark" href="/prato/updateForm/{{$prato->id}}">Editar</a>
    </div>        
@else
    <a href="/prato" class="btn btn-dark">Registrar prato do dia</a>
@endif
</div>

    
@endsection
