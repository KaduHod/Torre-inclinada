@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="Envelope">
    <form action="/cliente/update" method="post" id="Form" class="formCliente ">
        @csrf 
        <div class="formAmarelo">
            <h3>Cliente</h3>
            <input type="hidden" name="idCliente" value='{{$cliente->id}}'>
            <label for="NomeCliente">
                <span>Nome</span>
                <input type="text" name="NomeCliente" class="inputCustom" value="{{$cliente->Nome}}">
            </label>
            <label for="EmailCliente">
                <span>Email</span>
                <input type="email" name="EmailCliente" class="inputCustom" value="{{$cliente->Email}}">
            </label>
            <label for="CPFCliente">
                <span>CPF</span>
                <input type="text" name="CPFCliente" class="inputCustom" value="{{$cliente->CPF}}">
            </label>
            <label for="CepCliente">
                <span>CEP</span>
                <input type="text" name="CepCliente" class="inputCustom"  value="{{$cliente->CEF}}">
            </label>
            <label for="CelCliente">
                <span>Celular/telefone</span>
                <input type="text" name="CelCliente" class="inputCustom" value="{{$cliente->Cel}}">
            </label>
        </div>
        <div id="Endereco">
            <label for="enderecos">
                <h3>Escolher tipo de endereço</h3>
                <select name="enderecos" class="form-select" id="enderecos">
                    
                    <option value="novoEndereco">Novo endereço</option>
                @foreach($cliente->enderecos as $endereco)
                
                    <option value="{{$endereco->id}}">{{$endereco->Rua}}, {{$endereco->Numero}}</option>
                
                @endforeach
                </select>
            </label>
            <div class="formAmarelo endereco" id="endereco-novoEndereco">
                <label for="RuaCliente">
                    <span>Rua</span>
                    <input type="text" name="RuaCliente" id='RuaCliente' class="inputCustom">
                </label>
                <label for="BairroCliente">
                    <span>Bairro</span>
                    <input type="text" name="BairroCliente"  id='BairroCliente' class="inputCustom">
                </label>
                <label for="NumeroCliente">
                    <span>Número</span>
                    <input type="text" name="NumeroCliente" id='NumeroCliente' class="inputCustom">
                </label>
                <label for="ComplementoCliente">
                    <span>Complemento</span>
                    <input type="text" name="ComplementoCliente" id='ComplementoCliente' class="inputCustom">
                </label>
                <label for="CepCliente">
                    <span>CEP</span>
                    <input type="text" name="CepClienteEndereco" id='CepClienteEndereco' class="inputCustom">
                </label>
            </div>
            @foreach($cliente->enderecos as $endereco)
                    
                <div class="formAmarelo endereco hidden" id="endereco-{{$endereco->id}}">
                    <label for="RuaCliente">
                        <span>Rua</span>
                        <input type="text" name="RuaCliente" id='RuaCliente' class="inputCustom" value="{{$endereco->Rua}}">
                    </label>
                    <label for="BairroCliente">
                        <span>Bairro</span>
                        <input type="text" name="BairroCliente" id='BairroCliente' class="inputCustom" value="{{$endereco->Bairro}}">
                    </label>
                    <label for="NumeroCliente">
                        <span>Número</span>
                        <input type="text" name="NumeroCliente" id='NumeroCliente' class="inputCustom" value="{{$endereco->Numero}}">
                    </label>
                    <label for="ComplementoCliente">
                        <span>Complemento</span>
                        <input type="text" name="ComplementoCliente" id='ComplementoCliente' class="inputCustom" value="{{$endereco->Complemento}}">
                    </label>
                    <label for="CepCliente">
                        <span>CEP</span>
                        <input type="text" name="CepClienteEndereco" id='CepClienteEndereco' class="inputCustom" value="{{$endereco->CEP}}">
                    </label>
                </div>
                    
            @endforeach
            
        </div>
        
        <div class="flex flexColumn">
            
            <button type="submit" class='btn btn-dark'>Salvar</button>
        </div>
        
        
    </form>
    <script>
        let form = document.getElementById('Form')
        

        form.addEventListener('submit',function(e){

            let valoresInputs = [... form.getElementsByTagName('input')].filter(input=>{
                if(input.getAttribute('name')) return input.value
            })

            let verificaCamposPreenchidos = valoresInputs.indexOf('') > -1 ? false : true

            if(verificaCamposPreenchidos) e.submit()

            alert('Preencha os campos antes de salvar o cliente!')

            e.preventDefault()
            
        })

        let select = document.getElementById('enderecos')
            select.addEventListener('change', mudaEnderecoDiv)

        function mudaEnderecoDiv(){
            escondeDivsEnderecos() 

            let divEnderecoEscolhido = document.getElementById(`endereco-${this.value}`)
                divEnderecoEscolhido.classList.remove('hidden')
                console.log(divEnderecoEscolhido)
            desabilitaInputsEndereco()
            var inputsHabilitados = habilitaInputsDeDiv(divEnderecoEscolhido)
        }
        function escondeDivsEnderecos(){
            let enderecosDiv = [... document.getElementsByClassName('endereco')]
            enderecosDiv.forEach(div=>{
                let verificaSeTemHidden = [... div.classList].indexOf('hidden') > -1 ? true : false
                if(!verificaSeTemHidden) div.classList.add('hidden')
            })
        }

        function desabilitaInputsEndereco(){
            let divEnderecoInputs = [... document.getElementById('Endereco').getElementsByTagName('input')]
                divEnderecoInputs.forEach( input =>{
                    input.removeAttribute('name')
                })
        }
        

        function habilitaInputsDeDiv(div){
            let inputs = [... div.getElementsByTagName('input')]
            inputs.forEach(input => {
                input.setAttribute('name', `${input.id}`)
                console.log('habilitado', input)
            })
            return inputs
        }
        
    </script>
</div>

@endsection