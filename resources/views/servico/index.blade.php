@extends('templates.master')

@section('css-view')
<style type="text/css">
    #tabela-servicos {
        background: white;
        border-collapse: collapse;
        border-color: #ebebeebd;
    }

    #tabela-servicos > thead > tr > th, 
    #tabela-servicos > tbody > tr > td {
        padding: 0.3rem 1.3rem;
        text-align: center;
    }
    #tabela-servicos > tbody > tr:nth-child(odd) {
        background-color: #f7f7f7bd;
    }
    #tabela-servicos > tbody > tr:nth-child(even) {
        background-color: #b8b8b8bd;
    }

    #container-header-servicos {
        overflow: auto;
        margin-bottom: 20px;
    }

    #header-servicos {
        float: left;
    }

    #adicionar-servico {
        float: right;
    }

    #btn-novo-servico {
        margin: 1.4rem;
    }

</style>
@endsection
@section('conteudo-view')
    <div class="container bg-light-gray">
        <div id="container-header-servicos">
            <h1 id="header-servicos">Seus Serviços</h1>
            @if(Auth::user()->temPerfilCliente())
                <div id="adicionar-servico">
                    <a 
                        id="btn-novo-servico"
                        class="btn bg-yellow"
                        href="{{route('servico.create')}}"
                    >
                        Novo Serviço
                    </a>
                </div>
            @endif
        </div>
        @include('servico.templates.lista')
    </div>
@endsection