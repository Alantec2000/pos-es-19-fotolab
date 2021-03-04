@extends('templates.master')

@section('conteudo-view')
    <p id="erros">
        @include('templates.errors', [
            'errors' => $errors,
            'field' => 'email'
        ])
    </p>
    <form method="POST" action="{{ route('usuario.cadastro.novo') }}">
        @csrf
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email">
        
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha">
        
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome">
        
        <label for="sobrenome">Sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome">
        
        <label for="email">Data de nascimento</label>
        <input type="text" id="data_nascimento" name="data_nascimento">
        {{-- <input type="button" class="file" name="attachement" onmouseover="(this.type='file')" onmouseout="(this.type='button')" value="Foto do perfil" /> --}}
        {{-- <input type="button" class="file" name="attachement" onmouseover="(this.type='file')" onmouseout="(this.type='button')" value="Foto de capa" /> --}}
        <input type="radio" id="fotografo" name="tipo" value="Fotografo">
        <label for="email">Fotografo</label>
        
        <input type="radio" id="cliente" name="tipo" value="Cliente">
        <label for="email">Cliente</label>
        
        <button>Cadastrar</button>
    </form>
@endsection