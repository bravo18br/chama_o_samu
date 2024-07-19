<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <input id="visita_id" class="hidden" value="{{ $visita_id }}">
                @if(!$abertos_lista && !$em_andamento_lista && !$encerrados_lista && !$cancelados_lista)
                <h2 class="card m-1 p-1">Não existem chamados para serem exibidos</h2>
                @endif
                @if($abertos_lista)
                <div>
                    <h2 class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(185, 47, 47, 0.911);" title="Chamados que precisam de atenção imediata">Chamados abertos</h2>
                    @foreach($abertos_lista as $chamado)
                    <div class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(164, 186, 178, 0.6);">
                        @include('layoutcardchamado')
                    </div>
                    @endforeach
                </div>
                @endif

                @if($em_andamento_lista)
                <div>
                    <h2 class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(153, 202, 7, 0.6);" title="Chamados que estão sendo resolvidos">Chamados em andamento</h2>
                    @foreach($em_andamento_lista as $chamado)
                    <div class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(164, 186, 178, 0.6);">
                        @include('layoutcardchamado')
                    </div>
                    @endforeach
                </div>
                @endif

                @if($encerrados_lista)
                <div>
                    <h2 class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(112, 112, 112, 0.6);" title="Chamados que já foram resolvidos">Chamados encerrados</h2>
                    @foreach($encerrados_lista as $chamado)
                    <div class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(164, 186, 178, 0.6);">
                        @include('layoutcardchamado')
                    </div>
                    @endforeach
                </div>
                @endif

                @if($cancelados_lista)
                <div>
                    <h2 class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(136, 138, 136, 0.6);" title="Chamados incompletos (usuário iniciou, mas não concluiu)">Chamados cancelados</h2>
                    @foreach($cancelados_lista as $chamado)
                    <div class="card m-1 p-1" style="border: solid black 2px; background-color: rgba(164, 186, 178, 0.6);">
                        @include('layoutcardchamado')
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>