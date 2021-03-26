<div id="menu-perfil">
    <div id="menu-usuario">
        <a href="{{ route('servico.index')}}" class="link-menu-usuario">Serviços</a>
        <span class="separador-menu">|</span>
        @if (Auth::user()->temPerfilFotografo())
            <a href="{{route('fotografo.portfolio.index')}}" class="link-menu-usuario">Portfólio</a>
        @endif
        <span class="separador-menu">|</span>
        <a href="{{ route('deslogar') }}" class="link-menu-usuario">Sair</a>
    </div>
    <div id="nome-usuario">
        <a href="#" class="btn bg-yellow">
            Ver Perfil
        </a>
    </div>
</div>