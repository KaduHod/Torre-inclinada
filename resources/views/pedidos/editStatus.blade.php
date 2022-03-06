@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')
<div class="ContainerComPaddingPadrao" >
    <h1>Mudar status do pedido</h1>
    <div class="border" id="editPedidoContainer" style="overflow: hidden">
        <div id="infoPedido">
            <li><span>Cliente</span>: <a href="/cliente/edit/{{$pedido->cliente->id}}">{{$pedido->cliente->Nome}}</a> </li>
            <li><span>Prato</span>: {{$pedido->prato['Nome prato']}}</li>
            <li><span>Data do pedido</span>: {{$pedido->created_at->format('Y-m-d H:i:s')}}</li>
            <li><span>Data de atualização</span>: {{$pedido->updated_at->format('Y-m-d H:i:s')}}</li>
            <li><span>Endereço</span>: {{$pedido->Endereco->Rua}}, {{$pedido->Endereco->Numero}} - {{$pedido->Endereco->Bairro}}</li>
            @if($pedido->funcionario_id)
                <li><span>Funcionario responsável</span>: {{$pedido->funcionario_id}}</li>
            @else
                <li><span>Funcionario responsável</span>: Sem funcionario</li>
            @endif
            
            @if($pedido->adendo)
                <li><span>Adendo</span>: {{$pedido->adendo}}</li> 
            @else
                <li><span>Adendo</span>: Sem adendo</li> 
            
            @endif

            <h3 id='preco'>R$ {{$pedido->prato->preco}}</h3>
            
        </div>
        <form action="/Pedidos/status-editado" id="formStatus" method="POST" name='status' class="InputCustom">
            @csrf
            <input type="hidden" name="idPedido" value='{{$pedido->id}}'>
            <select name="Status" id="">
                @if($pedido->status == 'Preparando pedido')
                    <option value="{{$pedido->status}}">{{$pedido->status}}</option>
                    <option value="Pronto para entrega">Pronto para entrega</option>
                    <option value="Em rota de entraga">Em rota de entraga</option>
                    <option value="Entregue">Entregue</option> 
                    <option value="Cancelado">Cancelar</option>
                @endif
                @if($pedido->status == 'Entregue')
                    <option value="{{$pedido->status}}">{{$pedido->status}}</option>
                    <option value="Pronto para entrega">Pronto para entrega</option>
                    <option value="Em rota de entraga">Em rota de entraga</option>
                    <option value="Preparando pedido">Preparando pedido</option>
                    <option value="Cancelado">Cancelar</option>
                    
                @endif
                @if($pedido->status == 'Em rota de entraga' || $pedido->status == 'Saiu para entrega')
                    <option value="{{$pedido->status}}">{{$pedido->status}}</option>
                    <option value="Pronto para entrega">Pronto para entrega</option>
                    <option value="Entregue">Entregue</option>
                    <option value="Preparando pedido">Preparando pedido</option>
                    <option value="Cancelado">Cancelar</option>
                @endif
                @if($pedido->status == 'Pronto para entrega')
                    <option value="{{$pedido->status}}">{{$pedido->status}}</option>
                    <option value="Em rota de entraga">Em rota de entraga</option>
                    <option value="Entregue">Entregue</option>
                    <option value="Preparando pedido">Preparando pedido</option>
                    <option value="Cancelado">Cancelar</option>
                @endif
                @if($pedido->status == 'Cancelado')
                    <option value="{{$pedido->status}}">Cancelado</option>
                    <option value="Em rota de entraga">Em rota de entraga</option>
                    <option value="Entregue">Entregue</option>
                    <option value="Preparando pedido">Preparando pedido</option>
                    <option value="Pronto para entrega">Pronto para entrega</option>
                @endif
            </select>

            <button type="submit" class="btn btn-dark">Salvar</button>

        </form>
    </div>
</div>
<script>
    
</script>
@endsection