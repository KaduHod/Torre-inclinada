@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')


<form action="/admin/funcionario/store" method="post">
    @csrf
    <label for="name">Nome</label>
    <input type="text" name="name">
    <label for="email">Email</label>
    <input type="email" name="email">
    <label for="password">Senha</label>
    <input type="password" name="password">
    <label for="password_confirmation">Confirmação de senha</label>
    <input type="password" name="password_confirmation">
    
    <label for="staff">Cargo</label>
    <select name="staff" >
        <option value="Admin">Admin</option>
        <option value="Cozinheiro">Cozinheiro</option>
        <option value="Entregador">Entregador</option>
        <option value="Atendente">Atendente</option>
        <option value="Desenvolvedor">Desenvolvedor</option>
    </select>
    
    <button type="submit">Salvar</button>
</form>
@endsection