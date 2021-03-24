@extends('templates.master')

@section('conteudo-view')
    <div id="form-session">
        <form method="POST" id="form_novo_servico" action="{{ route('servico.store') }}" class="panel-cadastro">
            @csrf
            <div class="d-r">
                <h2>CADASTRO DE SERVIÇO</h2>
            </div>
            <p id="erros">
                @include('templates.errors', [
                    'errors' => $errors,
                    'field' => 'email'
                ])
            </p>

            <div id="ft_form_novo_servico" class="form">

                <div class="d-r">
                    <label for="data_inicio">Inicio do evento:</label>
                    <input type='datetime-local' id="data_inicio" name="data_inicio">
                </div>

                <div class="d-r">
                    <label for="data_fim">Final do evento:</label>
                    <input type='datetime-local' id="data_fim" name="data_fim">
                </div>

                <div class="d-r">
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Titulo do evento" onfocus="this.placeholder=''" onblur="this.placeholder='Titulo do evento'">
                </div>

                <div class="d-r">
                    <label for="descricao">Descrição:</label>
                    <textarea class="descricao_servico" id="descricao" name="descricao" form="form_novo_servico" rows="7" cols="34" placeholder="Descrição do evento" onfocus="this.placeholder=''" onblur="this.placeholder='Descrição do evento'"></textarea>
                </div>
        
                <div class="d-r j-ct-c">
                    <button type="submit" name="btnCadastrar" class="btn bg-dark w-1">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection