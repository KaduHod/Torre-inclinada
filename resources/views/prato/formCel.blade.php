@extends('layouts.mainCelphone')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="formContainer flexColumn "style='padding:20px'>
    <h1 class="TituloPadraoConfig">Criar prato</h1>
    <form action="/prato/store" id="formPratoDoDia" class="borderRadius BCbranco CardForm" method="post">
        
        @csrf
        <label class="labelCustom" for="preco">Nome
            <input class="inputCustom" type="text" id="NomePrato" name='NomePrato'>
        </label>
        <label class="labelCustom" for="preco">Ingredientes
            <input class="inputCustom" type="text" id="ingredientes" name='ingredientes'>
        </label>
        <label class="labelCustom" for="descricao">Descrição do prato 
            <textarea  class="inputCustom" id="descricao" name="descricao"
                rows="4" cols="50">
            Adicione uma descrição ao prato
            </textarea>
        </label>
        <label class="labelCustom" for="preco">Preço
            <input class="inputCustom" type="text" id="preco" name='preco'>
        </label>

        <button class="btn btn-dark" id="botaoPratoDoDia">Salvar</button>
    </form>

    <script src="/js/formPratoDia.js"></script>
</div>

@endsection