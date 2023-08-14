@extends('adminlte::page')

@section('title', 'Gerenciador de clientes')

@section('content')
<div class="container">
    <div class="form">
        <div class="form-service">
            <h1 class="type-service">Cadastro de Clientes</h1>
            <br>
            <form action="{{ url('customer-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column">
                    <label>Imagem</label>
                    <input type="file" name="img" class="form-control-file">
                </div>
                <br>
                <div class="d-flex">
                    <div class="d-flex flex-column w-100 m-1">
                        <label>Nome do cliente</label>
                        <input type="text" name="name" class="input-resp">
                    </div>

                    <div class="d-flex flex-column w-100 m-1">
                        <label>Email do cliente</label>
                        <input type="text" name="email" class="input-resp">
                    </div>
                </div>
                <br>
                <div class="d-flex">
                    <div class="d-flex flex-column w-100 m-1">
                        <label>Vendedor</label>
                        <select class="select-resp" name="seller">
                            <option></option>
                            @foreach($seller as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column w-100 m-1">
                        <label>Tipo de cliente</label>
                        <select class="select-resp" name="client_type">
                            <option></option>
                            <option value="1">Pessoa Física</option>
                            <option value="2">Pessoa Jurídica</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="d-flex flex-column w-100 m-1">
                        <label>Telefone</label>
                        <div class="d-flex">
                            <input type="text" name="phone[]" maxlength="15" onkeyup="handlePhone(event)" class="input-resp w-50">
                            <button class="btn btn-primary" onclick="newPhone(event)">+</button>
                        </div>
                        <div id="list-phone"></div>
                    </div>
                </div>

                <br>
                <button class="btn btn-primary" type="submit">Cadastrar</button>
                <a href="/customer" class="btn btn-secondary">Retornar</a>

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