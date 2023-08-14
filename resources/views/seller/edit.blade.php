@extends('adminlte::page')

@section('title', 'Gerenciador de clientes')

@section('content')
<div class="container">
    <div class="form">
        <div class="form-service">
            <h1 class="type-service">Editar Cadastro de Vendedores</h1>
            <br>
            <form action="{{ url('seller-update', $seller->id) }}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div>
                    <div class="d-flex">
                        <input name="name" type="text" required class="input-resp" value="{{ $seller->name }}" placeholder="Nome do Vendedor">
                        <input name="email" type="email" required class="input-resp" value="{{ $seller->email }}" placeholder="Email do Vendedor">
                    </div>
                </div>
                <br>
                <button class="btn btn-primary" type="submit">Cadastrar</button>
                <a href="/seller" class="btn btn-secondary">Retornar</a>
            </form>

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