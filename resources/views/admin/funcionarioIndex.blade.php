@extends('layouts.main')
@section('title','Torre Inlcinada Dashboard')
@section('content')


<a href="/admin/funcionario/create">
    <button class="btn btn-dark">Criar funcionario</button>
</a>



    <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Staff</th>
            <th scope="col">Criado em</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($funcionarios as $funcionario)
          <tr>
            <td>{{$funcionario->name}}</td>
            <td>{{$funcionario->email}}</td>
            <td>{{$funcionario->staff}}</td>
            <td>{{$funcionario->created_at}}</td>
            <td>
                <a href="/admin/funcionario/edit/{{$funcionario->id}}"><ion-icon style="color:green" class="iconAdmin" name="create-outline"></ion-icon></a>
                <a href="/admin/funcionario/excluir/{{$funcionario->id}}"><ion-icon style="color:red" class="iconAdmin" name="trash-outline"></ion-icon> </a>
                <a href="/admin/funcionario/simulate/{{$funcionario->id}}"><ion-icon style="color:orange" class="iconAdmin" name="enter-outline"></ion-icon></td></a>
                
                
          </tr>
        @endforeach
        </tbody>
      </table>


@endsection