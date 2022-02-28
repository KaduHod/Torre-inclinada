@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<form action="/Pedidos/store" id="pedidoForm" class="" method="post">
    @csrf
    {{-- Prato --}}
    <div class="divCustom border">
        <div id="pratoDoDia2 " class="">
            <h3 class="marginBottom">Escolher prato do pedido</h3>
            <label for="Pratos" class="marginBottom">
                <select name="Prato" id="Prato" class="form-select" id="pratosSelect">
                    @foreach($pratos as $prato)
                    <option value="{{$prato->id}}"  class="pratos" id="{{$prato->id}}">{{$prato['Nome prato']}}</option>
                    @endforeach
                </select>
            </label>
            <ul id="descPratos">
                <li><span>Nome do prato</span>: {{$pratos[0]['Nome prato']}}</li>
                <li><span>Ingredientes</span>: {{$pratos[0]->Ingredientes}} </li>
                <li><span>Descrição</span>: {{$pratos[0]->descricao}} </li>
                <li><span>Preço</span>: {{$pratos[0]->preco}} </li>
            </ul>
            <label for="AdendoPedido">
                <h3>Adendo ao pedido</h3>
                <textarea class="form-control" name="AdendoPedido" id="" cols="30" rows="5">
                </textarea>    
            </label>
        </div> 
        <div id="cliente" class="formAmarelo" style='width:500px'>
            <div id="clienteMenu" class="marginBottom">
                {{--<h3 class="active optCliente" >Novo Cliente</h3><h3 class="optCliente">Cliente ja registrado</h3>   --}}
                <div class="active optCliente" id="newClient">
                    <ion-icon class="iconPedido" name="person-add-sharp"></ion-icon>
                </div>
                <div class="optCliente" id="registeredClient">
                    
                    <ion-icon class="iconPedido" name="person-sharp"></ion-icon>
                </div>
            </div>
            <div class="inputsClientes ">
                <div id="NovoCliente">
                    <label for="NomeCliente">
                        <span>Nome do cliente:</span>
                        <input class="inputCustom NomeCliente" type="text" id="NomeCliente"  name="NomeCliente">
                    </label>
                    <label for="EmailCliente">
                        <span>Email do cliente:</span>
                        <input class="inputCustom EmailCliente" type="mail" id="EmailCliente"  name="EmailCliente">
                    </label>
                    <label for="CPFCliente">
                        <span>CPF do cliente:</span>
                        <input class="inputCustom CPFCliente" type="text" id="CPFCliente"  name="CPFCliente">
                    </label>
    
    
                    <label for="RuaNovoCliente">
                        <span>Rua:</span>
                        <input class="inputCustom EndereçoCliente" type="text" id="RuaNovoCliente"  name="RuaNovoCliente">
                    </label>
                    <label for="BairroNovoCliente">
                        <span>Bairro:</span>
                        <input class="inputCustom EndereçoCliente" type="text" id="BairroNovoCliente"  name="BairroNovoCliente">
                    </label>
                    <label for="NumeroNovoCliente">
                        <span>Numero:</span>
                        <input class="inputCustom EndereçoCliente" type="text" id="NumeroNovoCliente"  name="NumeroNovoCliente">
                    </label>
                    <label for="ComplementoNovoCliente">
                        <span>Complemento:</span>
                        <input class="inputCustom EndereçoCliente" type="text" id="ComplementoNovoCliente" name="ComplementoNovoCliente">
                    </label>
                    <label for="CEPNovoCliente">
                        <span>CEP:</span>
                        <input class="inputCustom EndereçoCliente" type="text" id="CEPNovoCliente" name="CEPNovoCliente">
                    </label>
                    <label for="CelCliente">
                        <span>Número de contato:</span>
                        <input class="inputCustom CelCliente" type="numer" id="CelCliente"  name="CelCliente">
                    </label>
                </div>
                <div id="ClienteRegistrado" class="hidden clienteRegistrado">
                    <div id="search">
                        <div class="md-form mt-0">
                            <label for="NomeClientes"></label>
                            <input class="inputCustom" id="NomeClientes" name="NomeClientes" list='clientes' type="search" placeholder="Pesquisar cliente" aria-label="Search">
                            <datalist id="clientes">
                                @foreach($clientes as $cliente)
                                    <option id="cliente-{{$cliente->id}}" class="ClientesLista" value="{{$cliente->Nome}}">
                                @endforeach
                                
                            </datalist>
                          </div>
                    </div>
                    <div id="ClienteRegistradoDadosUl">
                        <ul id="ClienteRegistradoDadosLi">
                            
                            <li><span>Nome </span>: </li>
                            <li><span>Email</span>: </li>
                            <li><span>CPF</span>:  </li>
                            <li><span>Cel</span>: </li>
                        </ul>
                    </div>
                    <div id="Endereco">
                        <select class="form-control" name="enderecos" id="enderecos" placeholder='Escolher endereço'>
                            <option value=""></option>
                            <option value="novoEndereco">Adicionar novo Endereço</option>
                            
                        </select>
                    </div>
                    <div id="EnderecoInfo" class="hidden">
                        <ul id="enderecoCompleto" >
                            <li><span>Rua </span>: </li>
                            <li><span>Bairro</span>: </li>
                            <li><span>Numero</span>:  </li>
                            <li><span>Complemento</span>: </li>
                        </ul>
                    </div>
                    <div id='NovoEndereco' class="hidden">
                        <label for="NOVOENDERECO: Bairro">
                            <span>Bairro</span>
                            <input class="inputCustom NOVOENDERECO:_Bairro" type="text" name="NOVOENDERECO: Bairro"  id="NOVOENDERECO: Bairro" >
                        </label>
                        <label for="NOVOENDERECO: Rua">
                            <span>Rua</span>
                            <input class="inputCustom NOVOENDERECO:_Rua" type="mail" name="NOVOENDERECO: Rua"  id="NOVOENDERECO: Rua" >
                        </label>
                        <label for="NOVOENDERECO: Número">
                            <span>Número</span>
                            <input class="inputCustom NOVOENDERECO:_Número" type="text" name="NOVOENDERECO: Número"  id="NOVOENDERECO: Número" >
                        </label>
                        <label for="NOVOENDERECO: Complementos">
                            <span>Complementos</span>
                            <input class="inputCustom NOVOENDERECO:_Complementos" type="text" name="NOVOENDERECO: Complementos"  id="NOVOENDERECO: Complementos" >
                        </label>
                        <label for="NOVOENDERECO: CEP">
                            <span>CEP</span>
                            <input class="inputCustom NOVOENDERECO:_CEP" type="text" id="NOVOENDERECO: CEP" name="NOVOENDERECO: CEP">
                        </label>
                        
                    </div>
                </div>
            </div>
            
            
            
            
        </div>
    </div>
    
    <button type="submit" class="btn btn-dark marginTop">Finalizar pedido</button>
</form>
<script src="/js/pedidosCreate.js"></script>
<script>
    let pratos = []
    @foreach($pratos as $prato)
        pratos.push({
            'id': {{$prato->id}},
            'Nome prato': '{{ $prato['Nome prato'] }}',
            'Ingredientes' : '{{$prato->Ingredientes}}',
            'Descricão' : '{{$prato->descricao}}',
            'Preço' : '{{$prato->preco}}'
        })
    @endforeach
    



    document.getElementById('Prato').addEventListener('change', botaPratoNoCard);   
    
    let NovoClienteClienteRegistrado = [... document.getElementsByClassName('optCliente')]
    NovoClienteClienteRegistrado.forEach(e=>{
        e.addEventListener('click', selecionaTipoCliente)
    })

    let clientes = []

    @forEach($clientes as $cliente)
   
        clientes.push({
            'id': {{$cliente->id}},
            'Nome': '{{$cliente->Nome}}',
            'Email' : "{{$cliente->Email}}",
            'CPF' : "{{$cliente->CPF}}",
            'Cel' : "{{$cliente->Cel}}",
            'enderecos' : {!! json_encode($cliente->enderecos)!!}.length > 0 ?  {!! json_encode($cliente->enderecos)!!} : false
        })
    
    @endforeach
    
    desabilitaInputsDiv(document.getElementById('ClienteRegistrado'))
    
    
</script>

@endsection