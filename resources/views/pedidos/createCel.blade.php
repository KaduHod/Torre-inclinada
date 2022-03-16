@extends('layouts.mainCelphone')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<form action="/Pedidos/store" id="pedidoForm" class="FormPedido" method="post">
    <h1 class="TituloPadraoConfig">Criar pedido</h1>
    @csrf
    {{-- Prato --}}
    <div class="CardForm BCbranco borderRadius marginTopBottom">
        <h4 class="TituloPadraoConfig">Escolher prato</h4>
        <div class="Center">
            <select class="borderRadius SelectCustom centro" name="Prato" id="Prato">
                @foreach($pratos as $prato)
                    <option value="{{$prato->id}}"  class="borderRadius" id="{{$prato->id}}">{{$prato['Nome prato']}}</option>
                @endforeach
            </select>
        </div>
        <div id='descPratos' class="">
        @foreach($pratos  as $prato)
        @if($loop->index > 0)
        <ul id="prato-{{$prato->id}}" class="pratoDesc hidden">
            <li><span>Nome do prato</span>: {{$prato['Nome prato']}}</li> 
            <li><span>Ingredientes</span>: {{$prato->Ingredientes}}</li> 
            <li><span>Descrição</span>: {{$prato->descricao}}</li> 
            <li><span>Preço</span>: R$ {{$prato->preco}}</li>  
        </ul>
        @else 
        <ul id="prato-{{$prato->id}}" class="pratoDesc">
            <li><span>Nome do prato</span>: {{$prato['Nome prato']}}</li> 
            <li><span>Ingredientes</span>: {{$prato->Ingredientes}}</li> 
            <li><span>Descrição</span>: {{$prato->descricao}}</li> 
            <li><span>Preço</span>: R$ {{$prato->preco}}</li>  
        </ul>
        @endif
            
            
        @endforeach
        </div>
        <label class="labelCustom" for="descricao"><h4 class="TituloPadraoConfig">Adendo do pedido</h4></label>
            <textarea  class="inputCustom" id="descricao" name="descricao"
                rows="2" cols="50">
                Escreva algum adendo ao cozinheiro
            </textarea>
        
        
    </div>
    
    <div class="section borderIOS">
        <div class="CardInfo ">
            {{--Opção estilo IOS--}}
            <div class="icon">
                <ion-icon name="person-outline"></ion-icon>
            </div>
            <div class="CardInfoTittle">
                Cadastrar cliente
            </div>
            <div class="icon showOptions">
                <ion-icon name="caret-down-outline"></ion-icon>
            </div>
        </div>
    
        <div class="CardInfoContent growUp "> 
            <div class='FormularioCliente'>
                <label for="NomeCliente">
                    <span>Nome</span>
                    <input type="text" name="NomeCliente" id="NomeCliente" class="inputCustom">
                </label>
                <label for="EmailCliente">
                    <span>Email</span>
                    <input type="email" name="EmailCliente" id="EmailCliente" class="inputCustom">
                </label>
                <label for="CPFCliente">
                    <span>CPF</span>
                    <input type="text" name="CPFCliente" id="CPFCliente" class="inputCustom">
                </label>
                <label for="CEPCliente">
                    <span>CEP</span>
                    <input type="text" name="CEPCliente" id="CEPCliente" class="inputCustom">
                </label>
                <label for="CelCliente">
                    <span>Celular/telefone</span>
                    <input type="text" name="CelCliente" id="CelCliente" class="inputCustom">
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
            </div>           
            
        </div>
    </div>
    <div class="section borderIOS">
        <div class="CardInfo ">
            {{--Opção estilo IOS--}}
            <div class="icon">
                <ion-icon name="person-add-outline"></ion-icon>
            </div>
            <div class="CardInfoTittle">
                Cliente já cadastrado 
            </div>
            <div class="icon showOptions">
                <ion-icon name="caret-down-outline"></ion-icon>
            </div>
        </div>
    
        <div class="CardInfoContent growUp ">            
            <div class="md-form mt-0">
                <label for="NomeClientes"></label>
                <input class="inputCustom" id="NomeClientes" name="NomeClientes" list='clientes' type="search" placeholder="Pesquisar cliente" aria-label="Search">
                <datalist id="clientes">
                    @foreach($clientes as $cliente)
                        <option id="cliente-{{$cliente->id}}" class="ClientesLista" value="{{$cliente->Nome}}">
                    @endforeach
                    
                </datalist>
            </div>
            <div id="ClienteRegistradoDadosUl">
                @foreach($clientes as $cliente)
                    <ul id="liCliente-{{$cliente->Nome}}" class="hidden">
                        <li><span>Nome </span>: {{$cliente->Nome}} </li>
                        <li><span>Email</span>: {{$cliente->Email}}</li>
                        <li><span>CPF</span>: {{$cliente->CPF}} </li>
                        <li><span>Cel</span>: {{$cliente->Cel}} </li>
                    </ul>
                    
                @endforeach
                <div class="section borderIOS hidden" id="NovoEnderecoClienteJaadastrado">
                    <div class="CardInfo ">
                        {{--Opção estilo IOS--}}
                        <div class="icon">
                            <ion-icon name="location-outline"></ion-icon>
                        </div>
                        <div class="CardInfoTittle">
                            Cadastrar novo endereço
                        </div>
                        <div class="icon showOptions">
                            <ion-icon name="caret-down-outline"></ion-icon>
                        </div>
                    </div>
                
                    <div class="CardInfoContent growUp ">
                        <div class="flexCloumn CemPorCento">
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
                <div class="section borderIOS hidden" id="EnderecoClienteJaadastrado">
                    <div class="CardInfo ">
                        {{--Opção estilo IOS--}}
                        <div class="icon">
                            <ion-icon name="location-outline"></ion-icon>
                        </div>
                        <div class="CardInfoTittle">
                            Endereços cadastrados
                        </div>
                        <div class="icon showOptions">
                            <ion-icon name="caret-down-outline"></ion-icon>
                        </div>
                    </div>
                
                    <div class="CardInfoContent growUp ">
                        <div class="flexCloumn CemPorCento">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>
{{-- <script src="/js/pedidosCreate.js"></script> --}}
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

    /*Handle dropDown*/
        let optionsSeta = [... document.getElementsByClassName('showOptions')]
            optionsSeta.forEach(seta => {
                seta.addEventListener('click',hadleOptionSeta)
            });


        function hadleOptionSeta(){
            let pai = this.parentNode.parentNode
            let divContent = pai.getElementsByClassName('CardInfoContent')[0]
            desabilitaInputs()
            hadleContent(divContent)
        }

        function hadleContent(div){
            let classes = [... div.classList]

            if( classes.length == 1 ) return growDown(div)
            
            return classes.indexOf('growDown') > -1 ? growUp(div) : growDown(div)
            
        }

        function growDown(div){
            let classes = [... div.classList]

            giraSetaCima(div)

            let verificaSeTiraGrowUp = classes.indexOf('growUp') > -1 ? div.classList.remove('growUp') : false
            div.classList.add('growDown')
        }

        function growUp(div){
            let classes = [... div.classList]

            let verificaSeTiraGrowDown = classes.indexOf('growDown') > -1 ? div.classList.remove('growDown') : false

            giraSetaBaixo(div)
            div.classList.add('growUp')
        }

        function giraSetaBaixo(div){
            let seta = div.previousElementSibling.lastElementChild
            seta.classList.remove('setaParaCima')
            
        }

        function giraSetaCima(div){
            let seta = div.previousElementSibling.lastElementChild
            seta.classList.add('setaParaCima')
        }

        function desabilitaInputs(){
            let form = document.getElementById('pedidoForm')
            let inputs = [... form.getElementsByTagName('input')]
            inputs.forEach(input=>{
                input.removeAttribute('name')
            })
        }

        function habilitaInputs(){
            
        }

        







    document.getElementById('Prato').addEventListener('change', botaPratoNoCard);
    
    function botaPratoNoCard(){
        let idPratoEscolhido = this.value
        let divASerMostrada = document.getElementById(`prato-${idPratoEscolhido}`)
        console.log(divASerMostrada)

        limpaCardDescPratos()

        let verificaHidden = [... divASerMostrada.classList].indexOf('hidden') > -1 ? true : false

        if(verificaHidden) divASerMostrada.classList.remove('hidden')
    }

    function limpaCardDescPratos(){
        let filhos = [... document.getElementById('descPratos').children]
        filhos.forEach(child => {
            child.classList.add('hidden')
        })
    }


    let searchCliente = document.getElementById('NomeClientes')
        searchCliente.addEventListener('change', handleSearchCliente)


    function handleSearchCliente(){
        let divASerMostrada = document.getElementById(`liCliente-${this.value}`)
        if(this.value.length < 1){
            escondeDescOutrosClientes()
            EscondeContainersEndereco()
            return 
        }
        escondeDescOutrosClientes()
        MostraDescClienteSearch(divASerMostrada)
        hadleEnderecos()
        
    }

    function MostraContainersEndereco(){
        let enderecosContainers = [... document.getElementById('ClienteRegistradoDadosUl').getElementsByClassName('section')]

        enderecosContainers.forEach( con => {
            con.classList.remove('hidden')
        })

    }
    function EscondeContainersEndereco(){
        let enderecosContainers = [... document.getElementById('ClienteRegistradoDadosUl').getElementsByClassName('section')]

        enderecosContainers.forEach( con => {
            con.classList.add('hidden')
        })

    }

    function hadleEnderecos(){
        MostraContainersEndereco()
    }


    

    function escondeDescOutrosClientes(){
        let containerDescClientes = document.getElementById('ClienteRegistradoDadosUl')
        let divClientes = [... containerDescClientes.getElementsByTagName('ul')]

        divClientes.forEach(item=>{
            let classes = [...item.classList]
            if(classes.indexOf('hidden') == -1) item.classList.add('hidden') 
        })
    }

    function MostraDescClienteSearch(divASerMostrada){
        
        divASerMostrada.classList.remove('hidden')
    }

    


   /*  document.getElementById('Prato').addEventListener('change', botaPratoNoCard);   
    
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
    
    desabilitaInputsDiv(document.getElementById('ClienteRegistrado')) */
    
    
</script>

@endsection