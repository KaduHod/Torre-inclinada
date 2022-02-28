let select = document.getElementById('Prato')
    select.addEventListener('change',mudaPrato)



let tipoCliente = [...document.getElementsByClassName('optCliente')]
    tipoCliente.forEach(div=>{
        //div.addEventListener('click', mudaTipoCliente)
        div.addEventListener('click',function(){
            let tipoCliente = mudatipoClienteIcone(this)
                tipoCliente == 'formCliente' ? desabilitaInputsDeDiv('formNovoCliente') : desabilitaInputsDeDiv('formCliente')
                setOptionNovoEndereco()
                tipoCliente == 'formCliente' ? habilitaInputsDeDiv('formCliente') : habilitaInputsDeDiv('formNovoCliente')
            
            mudaTipoCliente(tipoCliente)
        })
    })



var search = document.getElementById('NomeClientes')
    search.addEventListener('search',function(){
        mudaDescCliente()
        limpaOptionsSelectEndereco()
        let cliente = clientes.find( client => client.Nome == search.value )// Acho os dados do cliente selecionado
        handleIdCliente(cliente)
        adicionaEnderecosDeClienteNoSelectEnderecos(cliente) 
        escondeDivDescEndereco()
        mostraDivNovoEndereco()
    })

var selectEndereco = document.getElementById('enderecos')
    selectEndereco.addEventListener('change', function(){
        
        if(this.value !== 'novoEndereco'){// endereco cadastrado
            let enderecoSelecionado = mudaDescEndereco(this.value)
            escondeDivNovoEndereco()
            desabilitaInputsDeDiv('NovoEndereco')
            habilitaSelect('enderecos')
            botaDescEnderecoSelecionado(enderecoSelecionado)

        }else{// endereco novo

            escondeDivDescEndereco()
            desabilitaSelect('enderecos')
            habilitaInputsDeDiv('NovoEndereco')
            mostraDivNovoEndereco()
            

        }
       
    })

function setOptionNovoEndereco(){
    escondeDivDescEndereco()
    desabilitaSelect('enderecos')
    habilitaInputsDeDiv('NovoEndereco')
    mostraDivNovoEndereco() 
}

function handleIdCliente(cliente){
    document.getElementById('id_clienteSearch').value = cliente.id
    console.log(document.getElementById('id_clienteSearch'))
}

function verificacaoFormulario(){

    let inputsForm = [... document.getElementById('form').getElementsByTagName('input')]
    let selectForm = [... document.getElementById('form').getElementsByTagName('select')]
    let formulario = inputsForm.concat(selectForm)

    let camposHabilitados = separaDadosHabilitadosFormulario(formulario)
    console.log(camposHabilitados)
    removeClassInputSemValor(camposHabilitados)
    let analises = analiseValor(camposHabilitados)
    
    let verificaValorESeEComplemento = verificaAnalise(analises)//retornar campos sem valor ou liberar submit

    let possoDarSubmit = verificaValorESeEComplemento.length > 0 ? adicionaVermelhoEmInputSemValor(verificaValorESeEComplemento) : true

    return possoDarSubmit
}

function separaDadosHabilitadosFormulario(formulario){
    
    let campos = [... formulario].filter( input => {
        if(verificaSeInputEstaHabilitado(input) || input.id == 'id_clienteSearch') return input
    })
    
    return campos
}

function verificaAnalise(analises){// retorna inputs com erro
    let retorno = analises.reduce((acc, analise)=>{
        if(!analise.temValor) acc.push(analise.campo)
        return acc
    },[])

    return retorno
}

function removeClassInputSemValor(campos){
    campos.forEach(e=>{
        e.classList.remove('inputSemValor')
    })

}

function adicionaVermelhoEmInputSemValor(verificacao){
    verificacao.forEach(input => {
        input.classList.add('inputSemValor')
        console.log(input.name)
    })
    return false
}

function analiseValor(arrInputsHabilitados){
    let analise = arrInputsHabilitados.reduce((acc, campo)=>{
        let verifica = verificaValorInput(campo)
        if(verifica)acc.push(verifica)
        return acc
    },[])
    
    return analise
}

function verificaValorInput(input){
    let temValor = input.value === '' ? false : true
    //console.log(!verificaSeEComplemento(input))
    //if(!verificaSeEComplemento(input)) return {temValor:temValor, campo:input}
    /* let verifica = !verificaSeEComplemento(input)  ? {temValor:temValor, campo:input} : false

    console.log('verifica 1',verifica)
    return verifica */
    return !verificaSeEComplemento(input)  ? {temValor:temValor, campo:input} : false
    
}

function verificaSeEComplemento(campo){
    if(campo.getAttribute('name').indexOf('Complemento') !== -1) return true
}

function mudatipoClienteIcone(div){
    let irmao = div.nextElementSibling ? div.nextElementSibling : div.previousElementSibling
            
    let verificaSeJaFoiSelecionado = [...div.classList].indexOf('active') !== -1 ? true : false
            
    if(!verificaSeJaFoiSelecionado){
        div.classList.add('active')
        irmao.classList.remove('active')
                
        return div.id == 'newClient' ? 'formNovoCliente' : 'formCliente'
    }
    return false
}
    
function mudaTipoCliente(tipoCliente){// troca o form (cliente novo, cliente registrado)
    if(tipoCliente){
        let divASerMostrada = document.getElementById(tipoCliente)
    
        let irmao = divASerMostrada.nextElementSibling ? divASerMostrada.nextElementSibling : divASerMostrada.previousElementSibling
            
        divASerMostrada.classList.remove('hidden')
        irmao.classList.add('hidden')
    }        
}

function adicionaVermelhoEmInputSemValor(verificacao){
    verificacao.forEach(input => {
        input.classList.add('inputSemValor')
    })
}

function analiseValor(arrInputsHabilitados){
    let analise = arrInputsHabilitados.reduce((acc, campo)=>{
        let verifica = verificaValorInput(campo)
        if(verifica)acc.push(verifica)
        return acc
    },[])
    
    return analise
}

function verificaValorInput(input){
    let temValor = input.value === '' ? false : true
    return !verificaSeEComplemento(input)  ? {temValor:temValor, campo:input} : false
}

function verificaSeEComplemento(campo){
    if(campo.getAttribute('name')){
        if(campo.getAttribute('name').indexOf('Complemento') !== -1) return true
    }
}

function botaDescEnderecoSelecionado(enderecoSelecionado){
    let descEnderecoDiv = document.getElementById('EnderecoInfo')

    verificaDivHidden(descEnderecoDiv) ? mostraDivDescEndereco() : false
    
    descEnderecoDiv.innerHTML = `
        <li><span>Rua </span>: ${enderecoSelecionado.Rua} </li>
        <li><span>Bairro</span>: ${enderecoSelecionado.Bairro} </li>
        <li><span>Número</span>: ${enderecoSelecionado.Numero}  </li>
        <li><span>Complemento</span>: ${enderecoSelecionado.Complemento} </li>
        `
}

function escondeDivDescEndereco(){
    let descEnderecoDiv = document.getElementById('EnderecoInfo')
    if(!verificaDivHidden(descEnderecoDiv)) descEnderecoDiv.classList.add('hidden')
    return false
}

function mostraDivDescEndereco(){
    let descEnderecoDiv = document.getElementById('EnderecoInfo')
    if(verificaDivHidden(descEnderecoDiv)) descEnderecoDiv.classList.remove('hidden')
    return true

}

function mostraDivNovoEndereco(){
    let divNovoEndereco = document.getElementById('NovoEndereco')
    if(verificaDivHidden(divNovoEndereco)) divNovoEndereco.classList.remove('hidden')
}

function escondeDivNovoEndereco(){
    let divNovoEndereco = document.getElementById('NovoEndereco')
    if(!verificaDivHidden(divNovoEndereco)) divNovoEndereco.classList.add('hidden')
}

function mudaDescEndereco(idEndereco){
    return enderecos.find(endereco => endereco.id == idEndereco)
}

function limpaOptionsSelectEndereco(){
    let select = document.getElementById('enderecos') 

    while(select.childElementCount !== 1){
        select.removeChild(select.lastChild)
    }// remove os options do ultimo cliente
}

function adicionaEnderecosDeClienteNoSelectEnderecos(cliente){
    let select = document.getElementById('enderecos')

    cliente.enderecos.forEach(endereco => {
        let novoOptionComEndereco = document.createElement('option')
            novoOptionComEndereco.value = endereco.id
            novoOptionComEndereco.innerHTML = `${endereco.Rua}, ${endereco.Numero}`
            select.appendChild(novoOptionComEndereco)
    })   
}

function mudaDescCliente(){
    let mostrar = document.getElementById(`liCliente-${search.value}`)
        
    if(!verificaDivHidden(mostrar)){
        let esconde = document.getElementsByClassName('showDescClientes')[0]
            esconde.classList.add('hidden')
            esconde.classList.remove('showDescClientes')
            mostrar.classList.remove('hidden')
            mostrar.classList.add('showDescClientes')
    }
}

function mudaPrato(){
    let pratoMostrado = [...document.getElementsByClassName('showDescPrato')][0]
        pratoMostrado.classList.add('hidden')
        pratoMostrado.classList.remove('showDescPrato')

    let descDoPratoEscolhido = document.getElementById(`descPratos-${this.value}`)
        descDoPratoEscolhido.classList.remove('hidden')
        descDoPratoEscolhido.classList.add('showDescPrato')
}

function desabilitaInputsDeDiv(id){// removo o name dos inputs
    let inputsASeremDesabilitados = [... document.getElementById(id).getElementsByTagName('input')]
    inputsASeremDesabilitados.forEach(input=>{
        if(verificaSeInputEstaHabilitado(input)) input.removeAttribute('name')
    })
}

function habilitaInputsDeDiv(id){// adiciono o name dos atributos
    let inputsASeremHabilitados = [... document.getElementById(id).getElementsByTagName('input')]
    inputsASeremHabilitados.forEach(input=>{
        if(!verificaSeInputEstaHabilitado(input)) input.setAttribute('name', retornaId(input))
    })
}

function desabilitaSelect(id){
    let select = document.getElementById(id)
    if(verificaSeInputEstaHabilitado(select)) select.removeAttribute('name')
}

function habilitaSelect(id){
    let select = document.getElementById(id)
    if(!verificaSeInputEstaHabilitado(select)) select.setAttribute('name', retornaId(select))
}

function retornaId(input){
    return input.getAttribute('id')
}

function verificaDivHidden(elemento){
    return [... elemento.classList].indexOf('hidden') > -1 ? true : false
}

function verificaSeInputEstaHabilitado(input){
    if(input.getAttribute('name')) return true

    return false
}