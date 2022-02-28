document.getElementById('botaoPratoDoDia').addEventListener('click', (event)=>{
    event.preventDefault()
    
    let precoDigitado = this.preco.value
    if(precoDigitado.indexOf(',')>-1){
        this.preco.value = precoDigitado.replace(',','.')
    }
    this.formPratoDoDia.submit()

}, false)