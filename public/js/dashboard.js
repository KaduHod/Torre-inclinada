function handleDashboard(){
    let opcaoEscolhido = mudaOptionDeshboard(this)
    mostraDivHandle(opcaoEscolhido)
}

function mudaOptionDeshboard(elemento){
        resetaSelected(optionsDashboard)
        elemento.classList.add('selected')

        return elemento.parentNode
}

function mostraDivHandle(elemento){
    let name = elemento.getAttribute('name')
    let divEscolhida = document.getElementsByName(name)[1]

    if(verificaDivHidden(divEscolhida)) mostraDiv(divEscolhida)
}

function resetaSelected(options){

    options.forEach( opt => {
        verifica = [... opt.classList].indexOf('selected') > -1 ? true : false
        if(verifica) opt.classList.remove('selected') 
    })
    
}

function verificaDivHidden(div){
    let classList = [... div.classList]
    return classList.indexOf('hiddenDiv') > -1 ? true : false
}

function mostraDiv(div){
    let divAmostra = document.getElementsByClassName('showDiv')[0]
        escondeDiv(divAmostra)
    if(verificaDivHidden(div)) {
        div.classList.remove('hiddenDiv')
        div.classList.add('showDiv')
    }
}

function escondeDiv(div){
    if(!verificaDivHidden(div)) {
        div.classList.remove('showDiv')
        div.classList.add('hiddenDiv')
    }
}

function getPrato(id){
    return pratos.find(prato => prato.id == id)
}

function hadleStatus(){
    let status = mudaStatus()
    filtraTabela(status)
}

function mudaStatus(){
    let indiceDoAtual = controlaStatus.arr.indexOf(controlaStatus.current)
    if(indiceDoAtual > 3) indiceDoAtual = -1
    controlaStatus.current = controlaStatus.arr[indiceDoAtual+1]
    return controlaStatus.current
}

function filtraTabela(status){
    let statusTabela = [... document.getElementsByClassName('status')]
    statusTabela.forEach( valor => {
        if(valor.innerText !== status)valor.parentNode.classList.add('hidden')
        if(valor.innerText == status || status == 'todos')valor.parentNode.classList.remove('hidden')
    })
}

function redirectToPedido(){
    let urlPedido = 'http://localhost:8000/Pedidos/editar-status/' + this.id
    window.location.href = urlPedido
}