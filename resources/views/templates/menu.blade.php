<nav id="menu">
    <div>
        <h1>FotoLab</h1>
    </div>
    <div class="center">
        <a href="{{ route('home') }}" class="active">Home</a>
        <a href="">Avaliação</a>
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