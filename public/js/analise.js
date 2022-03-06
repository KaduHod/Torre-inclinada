
function separaPedidosPorDia(mes){
    let arrDias = arrAuxiliar.arrParaDados
    
    let pedidosPorDia = mes.reduce((acc, curr)=>{
            let indiceDia = getDiaIndice(curr.created_at)
            acc[indiceDia].push(curr)
            return acc
    }, arrDias)
    
    return pedidosPorDia
}
function getDiaIndice(data){
    let dia    = data.split('T')[0].split('-')[2]
    let indice = dia < 10 ? dia.split('')[1] : dia

    return parseInt(indice - 1)
}
function retornaArrayComNumeroDePedidosPorDia(pedidosSeparadosPorDia){
    let arrDias = arrAuxiliar.arrParaDados

    let arr = pedidosSeparadosPorDia.reduce((acc, valor, index)=>{
        acc.push(valor.length)
        return acc
    },[])

    return arr
}
function getValorPrato(id){
    let prato = pratos.find( prato => prato.id == id )
    return prato.preco
}
function getPrato(id){
    let prato = pratos.find( prato => prato.id == id )
    return prato
}
function somaValoresDoDia(dia){
    let valorTotDia = dia.reduce((acc, pedido)=>{
        let valorPrato = getValorPrato(pedido.prato_id)
        return acc+= valorPrato
    },0)

    return parseFloat(valorTotDia.toFixed(2))
}
function getValorGanhoPorDia(PedidosPorDia){
    let valoresArr = PedidosPorDia.map((dia)=>{
        return somaValoresDoDia(dia)
    })
    
    return valoresArr
}
function totalLucro(){
    let LucroTotalDoMes = query.reduce((acc,pedido)=>{
        let precoPrato = getValorPrato(pedido.prato_id)
        acc+= precoPrato
        return acc
    }, 0)
    return parseFloat(LucroTotalDoMes.toFixed(2)).toLocaleString('pt-br', {style: 'currency', currency:'BRL'})
}
function separaPedidos(query){
    let entregues = query.reduce((acc, pedido)=>{
        if(pedido.status == "Entregue") acc++
        return acc
    },0)
    let cancelados = query.reduce((acc, pedido)=>{
        if(pedido.status == "Cancelado") acc++
        return acc
    },0)

    return {
        entregues: entregues,
        cancelados: cancelados
    }
}
function quantidadeDeVendasPorPrato(Pedidos){
    let objAnalise    = Pedidos.reduce((acc,pedido)=>{
        let prato     = getPrato(pedido.prato_id)
        let nomePrato = prato['Nome prato']
        
        acc[nomePrato]++
        return acc
    },{
        'Prato segunda feira'      :0,
        'Terça feira'              :0,
        'Sexta feira'              :0,
        'Domingo'                  :0,
        'Segunda feira 2'          :0,
        'Segunda feira de carnaval':0,
        'Carnaval'                 :0
    })
    return objAnalise
}






    