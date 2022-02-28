@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="formContainer flexColumn "style='padding:20px'>
    
    <form action="/prato/store" id="formPratoDoDia" class="border" method="post">
        <h1>Criar prato</h1>
        @csrf
        <label for="preco">Nome: 
            <input class="inputCustom" type="text" id="NomePrato" name='NomePrato'>
        </label>
        <label for="preco">Ingredientes: 
            <input class="inputCustom" type="text" id="ingredientes" name='ingredientes'>
        </label>
        <label for="descricao">Descrição do prato: 
            <textarea  class="inputCustom" id="descricao" name="descricao"
                rows="4" cols="50">
            Adicione uma descrição ao prato
            </textarea>
        </label>
        <label for="preco">Preço: 
            <input class="inputCustom" type="text" id="preco" name='preco'>
        </label>

        <button class="btn btn-dark" id="botaoPratoDoDia">Salvar</button>
    </form>

    <script src="/js/formPratoDia.js"></script>
</div>

@endsection