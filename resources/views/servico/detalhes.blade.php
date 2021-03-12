@extends('templates.master')

@section('conteudo-view')
    <div id="detalhes-servico">
        <div id="titulo">
            {{$servico->titulo}}
        </div>
        <div id="status">
            {{$servico->status}}
        </div>
        <div id="data-inicio">
            {{$servico->data_inicio}}
        </div>
        <div id="data-fim">
            {{$servico->data_fim}}
        </div>
        <div id="descricao">
            {{$servico->data_fim}}
        </div>
    </div>
@endsection