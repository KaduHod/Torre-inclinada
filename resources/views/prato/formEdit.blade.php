@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="formContainer flexColumn" style="padding:30px">
    
    <form action="/prato/update" class="border" id="formPratoDoDia" class="" method="post">
        <h1>Editar prato</h1>
        @csrf
        <input type="hidden" name="id" value="{{$prato->id}}">
        <label for="preco">Nome 
            <input class="inputCustom" type="text" id="NomePrato" name='NomePrato' value="{{$prato['Nome prato']}}">
        </label>
        <label for="preco">Ingredientes: 
            <input class="inputCustom" type="text" id="ingredientes" name='ingredientes' value="{{$prato->Ingredientes}}">
        </label>
        <label for="descricao">Descrição do prato: 
            <textarea  class="inputCustom" id="descricao" name="descricao"
                rows="4" cols="50">
            {{$prato->descricao}}
            </textarea>
        </label>
        <label for="preco">Preço: 
            <input class="inputCustom" type="text" id="preco" name='preco' value="{{$prato->preco}}">
        </label>

        <button class="btn btn-dark" id="botaoPratoDoDia">Salvar</button>
    </form>

    <script src="/js/formPratoDia.js"></script>
</div>

@endsection