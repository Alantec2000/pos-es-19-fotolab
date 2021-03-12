@extends('templates.master')

@section('conteudo-view')
    <div class="panel">
        <h1>Serviços</h1>
        <div id="adicionar-servico">
            <a id="adicionar-novo-servico" href="{{route(usuario.servico.create)}}">Novo Serviço</a>
        </div>
        @include('servico.templates.lista')
    </div>
@endsection