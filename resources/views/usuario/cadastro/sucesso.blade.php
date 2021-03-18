@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
<div id="form-session">
    <div class="panel panel-2">
        <h2>Sucesso</h2>

        <a href="{{route('home')}}" class="btn bg-dark">Voltar para Home</a>
    </div>
</div>
@endsection


@section('js-view')
@endsection