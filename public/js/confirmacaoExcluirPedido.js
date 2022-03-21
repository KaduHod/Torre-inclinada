if(document.getElementsByClassName('notificacao2')[0]){
  var divNotificacao = document.getElementsByClassName('notificacao2')[0]
}else{
  var divNotificacao = document.getElementsByClassName('notificacao')[0]
}
    
var fechar = document.getElementById('fecharNotificacao')
    fechar.addEventListener('click', fechaConfirmacao)

var excluir = document.getElementById('excluir')

var iconesExcluir = [... document.getElementsByName('trash-outline')]
    iconesExcluir.forEach( icone => {
      icone.addEventListener('click', confirmacao)
    });

  
function setPrefix(){
  let url_atual = window.location.href;
  if(url_atual.indexOf('Clientes') > -1){

    return '/cliente/exclude/'
  }
  if(url_atual.indexOf('Pedidos') > -1){
    return '/Pedidos/exclude/'
  }
  if(url_atual.indexOf('pratos') > -1){
    return '/prato/exclude/'
  }
}



function confirmacao(){
  let prefix = setPrefix()
  let verifica = [... divNotificacao.classList].indexOf('fade-in') == -1 ? true : false
  if(verifica){
    divNotificacao.classList.add('fade-in')
    excluir.href = `${prefix}${this.id}`

  } 
  confirmacao.focus()
}

function fechaConfirmacao(){
  let verifica = [... divNotificacao.classList].indexOf('fade-in') > -1 ? true : false
  if(verifica){
    divNotificacao.classList.remove('fade-in')
    divNotificacao.getElementsByClassName.top = 'none'
    excluir.href = '#'
  } 
}