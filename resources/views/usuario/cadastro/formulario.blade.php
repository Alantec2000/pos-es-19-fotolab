@extends('templates.master')

@section('conteudo-view')
    <div id="form-session">
        <p id="erros">
            @include('templates.errors', [
                'errors' => $errors,
                'field' => 'email'
            ])
        </p>
        <form method="POST" action="{{ route('cadastro.novo') }}" class="panel-cadastro">
            @csrf
            <div class="d-r">
                <h2>CADASTRO</h2>
            </div>

            <div class="d-r">
                
                    <label class="lbl-perfil">Tipo do perfil:</label>
                    <div class="perfil-radio">
                        <div>
                            <input type="radio" id="fotografo" name="tipo" value="Fotografo">
                            <label for="fotografo">Fotografo</label>
                        </div>
                        <div>
                            <input type="radio" id="cliente" name="tipo" value="Cliente">
                            <label for="cliente">Cliente</label>
                        </div>
                    </div>    
            </div>

            <div id="ft_form_novo_usuario" class="form">

                <div class="d-r">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" onfocus="this.placeholder=''" onblur="this.placeholder='Seu nome'">
                </div>

                <div class="d-r">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" placeholder="Seu sobrenome" onfocus="this.placeholder=''" onblur="this.placeholder='Seu sobrenome'">
                </div>

                <div class="d-r">
                    <label for="data_nascimento">Data de nascimento:</label>
                    <input type='date' id="data_nascimento" name="data_nascimento">
                </div>

                <div class="d-r">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" placeholder="seu_email@exemplo.com" onfocus="this.placeholder=''" onblur="this.placeholder='seu_email@exemplo.com'">
                </div>

                <div class="d-r">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" onfocus="this.placeholder=''" onblur="this.placeholder='Sua senha'">
                </div>
        
            {{-- <input type="button" class="file" name="attachement" onmouseover="(this.type='file')" onmouseout="(this.type='button')" value="Foto do perfil" /> --}}
            {{-- <input type="button" class="file" name="attachement" onmouseover="(this.type='file')" onmouseout="(this.type='button')" value="Foto de capa" /> --}}
                <div class="d-r j-ct-c">
                    <button type="submit" name="btnCadastrar" class="btn bg-dark w-1">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection