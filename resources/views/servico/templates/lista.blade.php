<table id="tabela-servicos" border="1">
    <thead>
        @if (Auth::user()->temPerfilFotografo())
            <th>Contratado</th>
        @elseif (Auth::user()->temPerfilCliente())
            <th>Contratante</th>
        @endif
        <th>Título</th>
        <th>Status</th>
        <th title="Data de início do serviço">Data Início</th>
        <th title="Data de Fim do serviço">Data Fim</th>
        <th title="Data de criação">Data Criação</th>
        <th title="Avaliado">Avaliado</th>
        <th title="Ações">#</th>
    </thead>
    <tbody>
        @forelse($servicos as $servico)
            <tr>
                @if (Auth::user()->temPerfilFotografo())
                    <td>{{$servico->cliente->nome}}</td>
                @elseif (Auth::user()->temPerfilCliente())
                    <td>{{$servico->fotografo->nome}}</td>
                @endif
                <td class="titulo-servico">{{Str::limit($servico->titulo, 20)}}</td>
                <td>{{$servico->status}}</td>
                <td>{{$servico->data_inicio}}</td>
                <td>{{$servico->data_fim}}</td>
                <td>{{$servico->created_at}}</td>
                @if (Auth::user()->temPerfilFotografo())
                    <td>{{$servico->avaliado ? "Sim" : "Não"}}</td>
                @endif
                <td>
                    <a 
                        href="{{route('servico.show', [
                            'servico' => $servico->id
                        ])}}"
                        class="btn bg-dark"
                    >
                        Detalhes
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">
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