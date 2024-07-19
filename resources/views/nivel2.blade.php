<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form id="formulario" action="/nivel2" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex p-3" style="flex-wrap: wrap; justify-content: center; align-items: center;">
                        @foreach($auxiliares as $linha)
                        @if ($linha->nivel=='cancelar')
                        <div id="id_{{ $linha->nivel }}" class="div_cartao {{ $linha->nivel }}" cartao_nivel="{{ $linha->nivel }}">
                            <input class="hidden" type="checkbox" id="cartao_{{ $linha->id }}" name="cartoes_selecionados[]" value="{{ $linha->id }}">
                            <label for="cartao_{{ $linha->id }}">
                                <img class="img_cartao" src="/storage/images/{{ $linha->imagem_nome }}" alt="{{ $linha->legenda_user }}" title="{{ $linha->legenda_user }}">
                            </label>
                            <p class="hidden legenda_samu" legenda_samu="{{ $linha->legenda_samu }}"></p>
                            <p class="legenda_user">{{ $linha->legenda_user }}</p>
                        </div>
                        @endif
                        @endforeach

                        @foreach($cartoes_nivel2 as $linha)
                        <div class="div_cartao {{ $linha->nivel }}" cartao_nivel="{{ $linha->nivel }}">
                            <input class="hidden" type="checkbox" id="cartao_{{ $linha->id }}" name="cartoes_selecionados[]" value="{{ $linha->id }}">
                            <label for="cartao_{{ $linha->id }}">
                                <img class="img_cartao" src="/storage/images/{{ $linha->imagem_nome }}" alt="{{ $linha->legenda_user }}" title="{{ $linha->legenda_user }}">
                            </label>
                            <p class="hidden legenda_samu" legenda_samu="{{ $linha->legenda_samu }}"></p>
                            <p class="legenda_user">{{ $linha->legenda_user }}</p>
                        </div>
                        @endforeach
                        <div class="d-none">
                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" required>
                            <input type="text" name="chamado_id" value="{{ $chamado_id }}" required>
                            <button id="botao_enviar" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>