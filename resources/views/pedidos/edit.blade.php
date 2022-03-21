@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<form action="/Pedidos/update" method="POST" id="form" class="conteiner  flexColumn">
    @csrf
    <input type="hidden" name="idPedido" id="idPedido" value="{{$pedido->id}}">
    <div class="flex border sombra" id="Campode_formularios">
        <div id="pratoDoDia2" class=" ">
            <h3 class="marginBottom">Alterar  prato do pedido</h3>
            <label for="Pratos" class="marginBottom">
                <select name="Prato" id="Prato" class="form-select" id="pratosSelect">
                    <option value="{{$pedido->prato->id}}" class="pratos">{{$pedido->prato['Nome prato']}}</option>
                        @foreach($pratos as $prato)
                            @if($prato->id != $pedido->prato->id)
                                <option value="{{$prato->id}}"  class="pratos" id="{{$prato->id}}">{{$prato['Nome prato']}}</option>
                            @endif
                        @endforeach
                </select>
            </label>
            <ul id="descPratos-{{$pedido->prato->id}}" class="showDescPrato" >
                <li><span>Nome do prato</span>: {{$pedido->prato['Nome prato']}}</li>
                <li><span>Ingredientes</span>: {{$pedido->prato->Ingredientes}} </li>
                <li><span>Descrição</span>: {{$pedido->prato->descricao}} </li>
                <li><span>Preço</span>: {{$pedido->prato->preco}} </li>
            </ul>
            @foreach($pratos as $prato)
                @if($prato->id != $pedido->prato->id)
                    <ul id="descPratos-{{$prato->id}}" class="hidden" >
                        <li><span>Nome do prato</span>: {{$prato['Nome prato']}}</li>
                        <li><span>Ingredientes</span>: {{$prato->Ingredientes}} </li>
                        <li><span>Descrição</span>: {{$prato->descricao}} </li>
                        <li><span>Preço</span>: {{$prato->preco}} </li>
                    </ul>
                @endif
            @endforeach
            <label for="AdendoPedido">
                <h3>Adendo ao pedido</h3>
                <textarea class="form-control" name="AdendoPedido" id="" cols="15" rows="5">
                </textarea>    
            </label>
        </div> 
        <div id="Cliente" class="campoFomr flex flexColumn">
            <h3>Alterar cliente</h3>
            <div id="EscolherCliente" class="flex">
                <div class="active optCliente" id="newClient">
                    <ion-icon class="iconPedido" name="person-add-sharp"></ion-icon>
                </div><div class="optCliente" id="registeredClient">
                    <ion-icon class="iconPedido" name="person-sharp"></ion-icon>
                </div>
            </div>
            <div id="formNovoCliente" class="marginTop">
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
                    <input class="inputCustom CelCliente" type="text" id="CelCliente"  name="CelCliente">
                </label>
            </div>
            <div id="formCliente" class="hidden marginTop">
    
                <input type="hidden" id="id_clienteSearch" name="id_clienteSearch" value = "{{$pedido->cliente->id}}">
                <div id="search">
                    <div class="md-form mt-0">
                        <label for="NomeClientes"></label>
                        <input value='{{$pedido->cliente->Nome}}' class="inputCustom" id="NomeClientes" {{--name="NomeClientes"--}} list='clientes' type="search" placeholder="Pesquisar cliente" aria-label="Search">
                        <datalist id="clientes" >
                            @foreach($clientes as $cliente)
                                <option id="cliente-{{$cliente->id}}" class="ClientesLista" value="{{$cliente->Nome}}">
                            @endforeach
                            
                        </datalist>
                      </div>
                </div>
                <div id="ClienteRegistradoDadosUl">
                    <ul id="liCliente-{{$pedido->cliente->Nome}}" class="showDescClientes DescClienteUl">
                        
                        <li><span>Nome </span>: {{$pedido->cliente->Nome}} </li>
                        <li><span>Email</span>: {{$pedido->cliente->Email}}</li>
                        <li><span>CPF</span>: {{$pedido->cliente->CPF}} </li>
                        <li><span>Cel</span>: {{$pedido->cliente->Cel}} </li>
                    </ul>
                    @foreach($clientes as $cliente)
                        @if($cliente->Nome != $pedido->cliente->Nome)
                            <ul id="liCliente-{{$cliente->Nome}}" class="hidden">
                                <li><span>Nome </span>: {{$cliente->Nome}} </li>
                                <li><span>Email</span>: {{$cliente->Email}}</li>
                                <li><span>CPF</span>: {{$cliente->CPF}} </li>
                                <li><span>Cel</span>: {{$cliente->Cel}} </li>
                            </ul>
                        @endif
                    @endforeach
                    
                </div>
                <div id="Endereco">
                    <select class="inputCustom show" {{--name="enderecos"--}} id="enderecos" placeholder='Escolher endereço'>
                        <option value="novoEndereco">Adicionar novo Endereço</option>
                        @foreach($pedido->cliente->enderecos as $endereco)
                            <option value="{{$endereco->id}}">{{$endereco->Rua}}, {{$endereco->Numero}}</option>
                        @endforeach
                    </select>
                    <div id="EnderecoInfo" class="hidden">
                        <ul id="enderecoCompleto" >
                            <li><span>Rua </span>: </li>
                            <li><span>Bairro</span> : </li>
                            <li><span>Numero</span> :  </li>
                            <li><span>Complemento</span> : </li>
                        </ul>
                    </div>
                    <div id='NovoEndereco' class="marginTop">
                        <label for="NOVOENDERECO: Rua">
                            <span>Rua</span>
                            <input class="inputCustom NOVOENDERECO:_Rua" type="mail" {{--name="NOVOENDERECO: Rua"--}}  id="NOVOENDERECO: Rua" >
                        </label>
                        <label for="NOVOENDERECO: Bairro">
                            <span>Bairro</span>
                            <input class="inputCustom NOVOENDERECO:_Bairro" type="text" {{--name="NOVOENDERECO: Bairro"--}}  id="NOVOENDERECO: Bairro" >
                        </label>
                        <label for="NOVOENDERECO: Número">
                            <span>Número</span>
                            <input class="inputCustom NOVOENDERECO:_Número" type="text" {{--name="NOVOENDERECO: Número"--}}  id="NOVOENDERECO: Número" >
                        </label>
                        <label for="NOVOENDERECO: Complementos">
                            <span>Complementos</span>
                            <input class="inputCustom NOVOENDERECO:_Complemento" type="text" {{--name="NOVOENDERECO: Complementos"--}}  id="NOVOENDERECO: Complementos" >
                        </label>
                        <label for="NOVOENDERECO: CEP">
                            <span>CEP</span>
                            <input class="inputCustom NOVOENDERECO:_CEP" type="text" id="NOVOENDERECO: CEP" {{--name="NOVOENDERECO: CEP"--}}>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    



    </form>

<script src="/js/pedidosEdit.js"></script>
<script>
    var clientes = []

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
    var enderecos = []
    clientes.forEach(cliente=>{
        for(i=0;i<cliente.enderecos.length;i++){
            enderecos.push(cliente.enderecos[i])
        }
    })



    let form = document.getElementById('form')
    form.addEventListener('submit',function(event){
        event.preventDefault()

        verificacaoFormulario() ? form.submit() : alert('Verifique os campos digitados!')
    })
    
</script>

@endsection