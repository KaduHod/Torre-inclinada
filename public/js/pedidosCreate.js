function botaPratoNoCard(){
    let pratoEscolhido = pratos.filter(e=>{
        if(this.value == e.id) return e
    }) 
    
    let filhosCard = [...document.getElementById('descPratos').childNodes]
    filhosCard[1].innerHTML ="<span>Nome do prato</span>: " + pratoEscolhido[0]['Nome prato']
    filhosCard[3].innerHTML ="<span>Ingredientes</span>: " +  pratoEscolhido[0].Ingredientes
    filhosCard[5].innerHTML ="<span>Descrição</span>: " +  pratoEscolhido[0]['Descricão']
    filhosCard[7].innerHTML ="<span>Preço</span>: " +  pratoEscolhido[0]['Preço']

}
function desabilitaInputsDiv(div){
    
    let inputs = [... div.getElementsByTagName('input')]
    inputs.forEach(input=>{
        
        input.removeAttribute('name')
    })
}
function habilitaInputsDiv(div){
    
    let inputs = [... div.getElementsByTagName('input')]
    inputs.forEach(input=>{
        input.setAttribute('name',retornaIdSemFormControl(input))
    })
}
// function habilitaTodosOsInputs(){
//     let inputs1 = [... document.getElementById('NovoCliente').getElementsByTagName('input')]
//     let inputs2 = [... document.getElementById('ClienteRegistrado').getElementsByTagName('input')]
//     let inputs = inputs1.concat(inputs2)

//     inputs.forEach(input=>{
//         if(input.getAttribute('disabled')) input.removeAttribute('disabled')
//     })
    
// }

function retornaIdSemFormControl(input){
    return input.getAttribute('id')
}

function selecionaTipoCliente(){   
    let classes = [... this.classList]
    let irmaoH  = this.nextElementSibling ? this.nextElementSibling : this.previousElementSibling;
    console.log(this)
    console.log('this classes:',classes)

    if(classes.indexOf('active')==-1){
        this.classList.add('active')
        irmaoH.classList.remove('active')
    }

    let divaSerEscondida    = this.id == 'newClient' ? document.getElementById('ClienteRegistrado') : document.getElementById('NovoCliente');

    let divASerMostrada     = this.id == 'newClient' ? document.getElementById('NovoCliente') : document.getElementById('ClienteRegistrado');

    let divAserHabilitada   = this.id == 'newClient' ? document.getElementById('NovoCliente') : document.getElementById('ClienteRegistrado')

    let divASerDesabilitada = this.id == 'newClient' ? document.getElementById('ClienteRegistrado') : document.getElementById('NovoCliente')

    //habilitaTodosOsInputs()
    habilitaInputsDiv(divAserHabilitada)
    desabilitaInputsDiv(divASerDesabilitada)
    

    divaSerEscondida.classList.add('hidden')
    divASerMostrada.classList.remove('hidden')

}


let form = document.getElementById('pedidoForm')
    form.addEventListener('submit',()=>{
        event.preventDefault()

        let inputsTotal = [... form.getElementsByTagName('input')].filter(input=>{
            if(input.getAttribute('name')) return input
        })

        

        let arrNovoClienteInputs = [
            form.NomeCliente.value,
            form.EmailCliente.value,
            form.CPFCliente.value,
            form.RuaNovoCliente.value,
            form.BairroNovoCliente.value,
            form.NumeroNovoCliente.value,
            form.ComplementoNovoCliente.value,
            form.CEPNovoCliente.value,
            form.CelCliente.value
        ]
        let idCliente = form.idClienteJaRegistrado ? form.idClienteJaRegistrado.value : false
        let arrClienteJaCadastrado = [
            idCliente,
            form.NomeClientes.value,
            form.enderecos.value,
            form['NOVOENDERECO: Bairro'].value,
            form['NOVOENDERECO: Rua'].value,
            form['NOVOENDERECO: Número'].value,
            form['NOVOENDERECO: Complementos'].value,
            form['NOVOENDERECO: CEP'].value
            
        ]

        let tipoCadastro = inputsTotal.length > 8 ? {
            inputs : arrNovoClienteInputs,
            tipo : 'Novo'
        } : {
            inputs : arrClienteJaCadastrado,
            tipo : 'Já cadastrado'
        }
            
        if(tipoCadastro.tipo == 'Novo'){
            let verificaCamposPreenchidos = tipoCadastro.inputs.indexOf('') == -1 ? true : false

            if(verificaCamposPreenchidos) form.submit()
            else alert('Preencha os campos para cadastrar o cliente')

        }else{
            let verificaSeClienteFoiSelecionado = tipoCadastro.inputs[1] !== '' ? true : false

            if(!verificaSeClienteFoiSelecionado) alert('Selecione um cliente!')
            
            let confirmaSeEnderecoENovo = tipoCadastro.inputs[2] == 'novoEndereco' ? true : false

            if(confirmaSeEnderecoENovo) {
                
                let verificaSeCamposDeNovoEnderecoForamPreenchidos = tipoCadastro.inputs.slice(3,7).indexOf('') == -1 ? true : false 

                 if(verificaSeCamposDeNovoEnderecoForamPreenchidos) form.submit()
                 else alert('Preencha todos os campos do endereço novo!')

            }else{

                let verificaSeEnderecoFoiSelecionado = tipoCadastro.inputs[2].length > 0 ? true : false

                if(verificaSeEnderecoFoiSelecionado) form.submit() 
                else alert('Selecione um endereço!')
            } 
        }
    })  
//ENDEREÇO

let searchClientes = document.getElementById( 'NomeClientes' )
    searchClientes.addEventListener( 'search' ,botaInfosClienteJaRegistrado )

function botaInfosClienteJaRegistrado(){
    let dados1  = document.getElementById( 'ClienteRegistradoDadosLi' ).childNodes
    let cliente = retornaClienteDaPesquisa( this.value )

    
    dados1[1].innerHTML = `<li><span>Nome</span>: ${cliente.Nome} </li>`
    dados1[3].innerHTML = `<li><span>Email</span>: ${cliente.Email} </li>`
    dados1[5].innerHTML = `<li><span>CPF</span>: ${cliente.CPF} </li>`
    dados1[7].innerHTML = `<li><span>Cel</span>: ${cliente.Cel} </li>`

    let select = document.getElementById('enderecos')
    /* select.firstElementChild.value     = 'Endereco principal'
    select.firstElementChild.innerText = cliente['Endereco principal'] */
    

    DeixaSomenteOPrimeiroFilhoDeElemento(select)


    let inputIdCliente = document.createElement('input')
            inputIdCliente.setAttribute('type','hidden')
            inputIdCliente.setAttribute('value',`${cliente.id}`)
            inputIdCliente.setAttribute('id','idClienteJaRegistrado')
            inputIdCliente.setAttribute('name','idClienteJaRegistrado')
            select.appendChild(inputIdCliente)

    if(cliente.enderecos){
        
        cliente.enderecos.forEach( endereco => {
            
            let novoOptionDeEndereco           = document.createElement('option')
                //novoOptionDeEndereco.value     = `${endereco.id}-${cliente.id}`
                novoOptionDeEndereco.value     = `${endereco.id}`
                novoOptionDeEndereco.innerText = endereco.Numero != null ? `${endereco.Rua} n: ${endereco.Numero} ` : `${endereco.Rua} sem número `
                 
                select.appendChild(novoOptionDeEndereco)
        })
        
    } 

    select.addEventListener('change', ()=>{
       
        
        if(!isNaN(select.value)){// mudar para verificar se valor é inteiro
            let idEndereco = select.value

            
            document.getElementById('EnderecoInfo').classList.remove('hidden')
            document.getElementById('NovoEndereco').classList.add('hidden')

            cliente.enderecos.forEach( endereco => {
                if(endereco.id == idEndereco){
                    botaCardEndereco(endereco)
                } 
            })

        }else{
            if(select.value == 'novoEndereco'){
                document.getElementById('NovoEndereco').classList.remove('hidden')
                document.getElementById('EnderecoInfo').classList.add('hidden')
                
            }else{
                document.getElementById('NovoEndereco').classList.add('hidden')
                document.getElementById('EnderecoInfo').classList.add('hidden')
            }
        }
    })
}

function botaCardEndereco(endereco){
    let filhos = retornaFilhosSemText(document.getElementById('enderecoCompleto'))
    filhos[0].innerHTML = `<li><span>Rua</span>: ${endereco.Rua} </li>`
    filhos[1].innerHTML = `<li><span>Bairro</span>: ${endereco.Bairro} </li>`
    filhos[2].innerHTML = `<li><span>Numero</span>: ${endereco.Numero} </li>`
    filhos[3].innerHTML = `<li><span>Complemento</span>: ${endereco.Complemento} </li>`
}   

function retornaFilhosSemText(elemento){
    filhos1 = [... elemento.childNodes]
    let filhos = filhos1.filter( el => {
        if( el.innerText != undefined ) return el
    })

    return filhos
}
function DeixaSomenteOPrimeiroFilhoDeElemento( elemento ){
    while( elemento.childNodes.length > 4 ){
        elemento.removeChild( elemento.lastChild )
    }
}
function retornaClienteDaPesquisa( nome ){
    let cliente = clientes.filter( cliente =>{
        if( nome == cliente.Nome ) return cliente
    })
    
    return cliente[0]
}