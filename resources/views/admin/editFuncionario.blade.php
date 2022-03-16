@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')


<form action="/admin/funcionario/update" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$funcionario->id}}">
    <label for="name">Nome</label>
    <input type="text" name="name" value="{{$funcionario->name}}">
    <label for="email">Email</label>
    <input type="email" name="email" value="{{$funcionario->email}}">
    <label for="password">Nova Senha</label>
    <input type="password" name="password">
    <label for="password_confirmation">Confirmação de senha</label>
    <input type="password" name="password_confirmation">
    
    <label for="staff">Cargo</label>
    <select name="staff">
        @php
            $arrStaffs = [
                'Admin',
                'Cozinheiro',
                'Entregador',
                'Atendente',
                'Desenvolvedor'
            ];
        @endphp
        <option value="{{$funcionario->staff}}">{{$funcionario->staff}}</option>
        @foreach($arrStaffs as $cargo)
        @if($cargo !== $funcionario->staff)
        <option value="{{$cargo}}">{{$cargo}}</option>
        @endif
        @endforeach
    </select>
    
    <button type="submit">Salvar</button>
</form>
@endsection