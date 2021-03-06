<div id="servicos">
    <table>
        <thead>
            @if (Auth::user()->temPerfilFotografo())
                <td>Contratado</td>
            @elseif (Auth::user()->temPerfilCliente())
                <td>Contratante</td>
            @endif
            <th>Título</th>
            <th title="Data de início do serviço">Dt. Início</th>
            <th title="Data de Fim do serviço">Dt. Fim</th>
            <th title="Data de criação">Dt. Criação</th>
        </thead>
        <tbody>
            @forelse($servicos as $servico)
                <tr>
                    @if (Auth::user()->temPerfilFotografo())
                        <td>{{$servico->cliente->nome}}</td>
                    @elseif (Auth::user()->temPerfilCliente())
                        <td>{{$servico->fotografo->nome}}</td>
                    @endif
                    <td>{{$servico->titulo}}</td>
                    <td>{{$servico->data_inicio}}</td>
                    <td>{{$servico->data_fim}}</td>
                    <td>{{$servico->created_at}}</td>
                    @if (Auth::user()->temPerfilFotografo())
                        <td>{{$servico->avaliado ? "Sim" : "Não"}}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        @if (Auth::user()->temPerfilFotografo())
                            <h1>Nenhum serviço proposto até o momento :\</h1>
                        @elseif (Auth::user()->temPerfilCliente())
                            <h1>Você ainda não cadastrou serviços</h1>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>