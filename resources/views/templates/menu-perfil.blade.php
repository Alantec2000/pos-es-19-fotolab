<div id="menu-perfil">
    <div id="nome-usuario">
        {{Auth::user()->nome}}
    </div>
    <ul id="menu-perfil-opcoes">
        <li><a href="{{ route('servico.index')}}" class="btn bg-light-purple">Servicos</a></li>
        <li><a href="{{ route('deslogar') }}" class="btn bg-light-purple">Sair</a></li>
    </ul>
</div>