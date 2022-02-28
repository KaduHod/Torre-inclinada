@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="Envelope">
    <form action="/cliente/salvar" method="post" id="form" class="formCliente ">
        @csrf 
        <div class="formAmarelo">
            <h3>Cliente</h3>
            <label for="NomeCliente">
                <span>Nome</span>
                <input type="text" name="NomeCliente" class="inputCustom">
            </label>
            <label for="EmailCliente">
                <span>Email</span>
                <input type="email" name="EmailCliente" class="inputCustom">
            </label>
            <label for="CPFCliente">
                <span>CPF</span>
                <input type="text" name="CPFCliente" class="inputCustom">
            </label>
            <label for="CEPCliente">
                <span>CEP</span>
                <input type="text" name="CEPCliente" class="inputCustom">
            </label>
            <label for="CelCliente">
                <span>Celular/telefone</span>
                <input type="text" name="CelCliente" class="inputCustom">
            </label>
        </div>
        <div class="formAmarelo">
            <h3>Endereço</h3>
            <label for="RuaCliente">
                <span>Rua</span>
                <input type="text" name="RuaCliente" class="inputCustom">
            </label>
            <label for="BairroCliente">
                <span>Bairro</span>
                <input type="text" name="BairroCliente" class="inputCustom">
            </label>
            <label for="NumeroCliente">
                <span>Número</span>
                <input type="text" name="NumeroCliente" class="inputCustom">
            </label>
            <label for="ComplementoCliente">
                <span>Complemento</span>
                <input type="text" name="ComplementoCliente" class="inputCustom">
            </label>
            <label for="CepCliente">
                <span>CEP</span>
                <input type="text" name="CepCliente" class="inputCustom">
            </label>
        </div>
        <button type="submit" class='btn btn-dark'>Salvar</button>
    </form>
    <script>
        let form = document.getElementById('form')
        

        form.addEventListener('submit',function(e){

            let valoresInputs = [... form.getElementsByTagName('input')].map(input=>{
                return input.value
            })

            let verificaCamposPreenchidos = valoresInputs.indexOf('') > -1 ? false : true

            if(verificaCamposPreenchidos) e.submit()

            alert('Preencha os campos antes de salvar o cliente!')

            e.preventDefault()
            
        })
    </script>
</div>

@endsection