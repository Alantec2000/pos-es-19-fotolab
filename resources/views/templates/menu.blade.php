<nav id="menu">
    <div>
        <h1>
            <a id="logo-fotolab" href="{{ route('home') }}">FotoLab</a>
        </h1>
    </div>
    <div class="buttons">
        @guest
            <a href="{{ route('cadastro') }}" class="btn bg-yellow ">Cadastre - se</a>
            <a href="{{ route('login') }}" class="btn bg-light-purple">Acessar</a>
        @endguest

        @auth('web')
            @include("templates.menu-perfil")
        @endauth
    </div>

</nav>