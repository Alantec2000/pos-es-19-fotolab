<nav id="menu">
    <div id="logo-container">
        <h1>
            <a id="logo-fotolab" href="{{ route('home') }}">FotoLab</a>
        </h1>
    </div>
    <div id="separador-logo"></div>
    @auth('web')
        @include("templates.menu-perfil")
    @endauth
    <div id="botoes-acesso">
        @guest
            <a href="{{ route('cadastro') }}" class="btn bg-yellow ">Cadastre - se</a>
            <a href="{{ route('login') }}" class="btn bg-light-purple">Acessar</a>
        @endguest
    </div>
</nav>