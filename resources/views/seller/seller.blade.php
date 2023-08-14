@extends('adminlte::page')

@section('title', 'Gerenciador de clientes')

@section('content')
<div class="container">
    <div class="form">
        <div class="form-service">
            <div class="d-flex justify-content-between">
                <h1 class="type-service">Lista de Vendedores</h1>
                <div class="btn-new">
                    <a class="btn btn-primary" href="{{ url('seller-create') }}">Novo</a>
                </div>
            </div>
            <br>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seller as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ url('seller-edit', $item->id) }}">Editar</a>
                            <a class="btn btn-danger btn-sm" href="{{ url('seller-delete', $item->id) }}">Apagar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/script.js') }}"></script>
<script src="{{ asset('/js/mask.js') }}"></script>
@stop