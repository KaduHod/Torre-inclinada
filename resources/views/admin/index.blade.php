@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container">
    <div id="adminOptions">
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id="Pedido">
                
            </div>
            <div class="linkContainerAdminOption">
                <a href="/admin/pedidos"><button class="btn btn-dark">Gerenciar pedidos</button></a>
            </div>
        </div>
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id='Client'>
                
            </div>
            <div class="linkContainerAdminOption">               
                <a href="/admin/clientes"><button class="btn btn-dark">Gerenciar clientes</button></a>
            </div>
        </div>
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id="Prato">
                
            </div>
            <div class="linkContainerAdminOption">
                <a href="/admin/pratos"><button class="btn btn-dark">Gerenciar pratos</button></a>
                
            </div>
        </div>
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id="Faturamento">
                
            </div>
            <div class="linkContainerAdminOption">
               <a href="/admin/faturamento"><button class="btn btn-dark">Gerenciar Faturamento</button></a> 
            </div>
        </div>
    </div>
</div>

@endsection