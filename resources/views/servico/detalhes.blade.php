@extends('templates.master')

@section('css-view')
<style type="text/css">

    #cabecalho-container {
        overflow: auto;
    }

    #titulo-servico {
        float: left;
        max-width: 50rem;
    }

    #status-servico {
        float: right;
        margin-top: 1.4rem;
        margin-left: 1rem;
    }

</style>
@endsection

@section('conteudo-view')
    <div id="detalhes-servico" class="container bg-light-gray">
        <div id="cabecalho-container">
            <h1 id="titulo-servico">{{Str::limit($servico->titulo, 40)}}</h1>
            <span id="status-servico" class="btn {{$servico->classeStatus()}}">
                {{ucwords($servico->status)}}
            </span>
        </div>
        <p/>

        <div>
            <span for="lbl-data-inicio">Data do serviço: {{$servico->formatarDatas()}}</span>
        </div>
        <p/>

        <div id="descricao">
            <span for="lbl-descricao">Descrição do serviço: <br/> {{$servico->descricao}}</span>
        </div>
        <p/>

        @include('servico.templates.detalhe-footer', compact('servico'))
    </div>
@endsection