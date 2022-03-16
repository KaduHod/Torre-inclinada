@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')

<div class="container">
    <div id="adminOptions">
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id="Pedido">
                
            </div>
            <div class="linkContainerAdminOption">
                <a href="/Pedidos"><button class="btn btn-dark">Gerenciar pedidos</button></a>
            </div>
        </div>
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id='Client'>
                
            </div>
            <div class="linkContainerAdminOption">               
                <a href="/Clientes"><button class="btn btn-dark">Gerenciar clientes</button></a>
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
               <a href="/admin/faturamento"><button class="btn btn-dark">Visualizar Faturamento</button></a> 
            </div>
        </div>
        <div class="cardAdmin border">
            <div class="infoCardAdmin" id="Funcionarios">
                
            </div>
            <div class="linkContainerAdminOption">
               <a href="/admin/funcionario"><button class="btn btn-dark">Visualizar Funcionarios</button></a> 
            </div>
        </div>
    </div>
</div>

@endsection