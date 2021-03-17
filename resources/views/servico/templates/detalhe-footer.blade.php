<div id="servico-detalhe-footer">
    <hr>
    <p></p>
    <div style="float: right">
        @if (!$servico->avaliado)
            @if(Auth::user()->temPerfilCliente())
                @if($servico->status === 'finalizado' && !$servico->avaliado)
                    <a 
                        class="btn bg-yellow"
                        href="{{route('cliente.servico.avaliar', ['servico' => $servico->id])}}"
                    >
                        Avaliar
                    </a>
                @endif
                @if ($servico->status !== 'finalizado')
                    <a 
                        class="btn bg-red" 
                        href="{{route('cliente.servico.update.status', ['servico' => $servico->id,'status' => 'cancelado'])}}"
                    >
                        Cancelar
                    </a>
                @endif
            @endif
        @endif
        @if(Auth::user()->temPerfilFotografo())
            @if($servico->status === 'criado')
                <a 
                    class="btn bg-yellow"
                    href="{{route('fotografo.servico.update.status', ['servico' => $servico->id,'status' => 'analisando'])}}"
                >
                    Colocar em análise
                </a>
            @endif
            @if(!in_array($servico->status, ['proposta aceita', 'proposta recusada']))
                <a 
                    class="btn bg-green" 
                    href="{{route('fotografo.servico.update.status', ['servico' => $servico->id,'status' => 'proposta aceita'])}}"
                >
                    Aceitar
                </a>
                <a 
                    class="btn bg-red" 
                    href="{{route('fotografo.servico.update.status', ['servico' => $servico->id,'status' => 'proposta recusada'])}}"
                >
                    Recusar
                </a>
            @endif
        @endif
    </div>
</div>