<form id="formulario" action="/chamado" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="d-flex p-3" style="flex-wrap: wrap; justify-content: center; align-items: center;">
        @foreach($cartoes_nivel0 as $cartao)
        <div id="id_{{ $cartao->nivel }}" class="div_cartao {{ $cartao->nivel }}" cartao_nivel="{{ $cartao->nivel }}">
            <input class="hidden" type="checkbox" id="cartao_{{ $cartao->id }}" name="cartoes_selecionados[]" value="{{ $cartao->id }}">
            <label for="cartao_{{ $cartao->id }}">
                <img class="img_cartao" src="/storage/images/{{ $cartao->imagem_nome }}" alt="{{ $cartao->legenda_user }}" title="{{ $cartao->legenda_user }}">
            </label>
            <p class="hidden legenda_samu" legenda_samu="{{ $cartao->legenda_samu }}"></p>
            <p class="legenda_user">{{ $cartao->legenda_user }}</p>
        </div>
        @endforeach
    </div>
    <div class="d-none">
    <input type="text" name="user_id" value="{{ Auth::user()->id }}" required>
    <button id="botao_enviar" type="submit">Enviar</button>
    </div>
</form>