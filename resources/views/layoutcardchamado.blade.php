<div style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#exampleModal{{$chamado->id}}">
    @php
    $formataExibicao = new App\Helpers\FormataExibicao;
    @endphp
    @can('regras','operacao')
    <p>Nome: {{$chamado->user->name}}</p>
    <p id="id_chamado_id_{{$chamado->id}}" data-id="{{$chamado->id}}">Chamado ID: {{$chamado->id}}</p>
    <p>Abertura: {{ $formataExibicao->data_hora($chamado->created_at) }}</p>
    @endcan
    @can('regras','user')
    <p id="id_chamado_id_{{$chamado->id}}" data-id="{{$chamado->id}}">Chamado ID: {{$chamado->id}}</p>
    <p>Abertura: {{ $formataExibicao->data_hora($chamado->created_at) }}</p>
    <p title="Localização automática (talvez não seja precisa)">Geolocalização: {{$chamado->geolocalizacao}}</p>
    @endcan
</div>

<div class="modal fade" id="exampleModal{{$chamado->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" chamado_id="{{$chamado->id}}">
    <div class="modal-dialog" style="max-width:75%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Chamado</h5>
                <button type="button" class="btn-close btn btn-danger" aria-label="Close" onclick="location.reload();"
                    style="margin-left: auto;"></button>
            </div>
            <div class="modal-body">
                <div class="card m-1 p-1" style="background-color: transparent;">
                    <p id="id_latitude_value_{{$chamado->id}}" class="d-none" value="{{ $chamado->latitude }}"></p>
                    <p id="id_longitude_value_{{$chamado->id}}" class="d-none" value="{{ $chamado->longitude }}"></p>
                    <p>Solicitante</p>
                    <p>Nome: {{$chamado->user->name}}</p>
                    <p>Email: {{$chamado->user->email}}</p>
                    @can ('super-admin')
                    <p>Tipo usuário:
                        <?php
                        switch ($chamado->user->role) {
                            case 1:
                                echo "SuperAdmin";
                                break;
                            case 2:
                                echo "OperadorSamu";
                                break;
                            case 3:
                                echo "RegularUser";
                                break;
                            case 4:
                                echo "AdminSamu";
                                break;
                            default:
                                echo "Role inválida";
                        }
                        ?>
                    </p>
                    @endcan
                    <p>Analfabeto: {{ $chamado->user->analfabeto == 1 ? 'Sim' : 'Não' }}</p>
                    <p>Celular: {{ $formataExibicao->celular($chamado->user->celular) }}</p>
                    <p>CPF: {{ $formataExibicao->cpf($chamado->user->cpf) }}</p>
                    <p>CEP: {{ $formataExibicao->cep($chamado->user->cep) }}</p>
                    <p>Rua: {{$chamado->user->rua}}</p>
                    <p>Número: {{$chamado->user->numero}}</p>
                    @if ($chamado->user->complemento)
                    <p>Complemento: {{$chamado->user->complemento}}</p>
                    @endif
                </div>
                <div class="card m-1 p-1" style="background-color: transparent;">
                    <p>Ocorrência</p>
                    <p>Chamado ID: {{$chamado->id}}</p>
                    <p>Abertura: {{ $formataExibicao->data_hora($chamado->created_at) }}</p>
                    <p title="Localização automática (talvez não seja precisa)">Geolocalização:
                        {{$chamado->geolocalizacao}}</p>
                    <p class="{{ $chamado->anotacao_samu == null ? 'd-none' : 'd-flex' }}">Anotação SAMU:</p>
                    <textarea id="id_textarea_anotacao_{{$chamado->id}}"
                        class="{{ $chamado->anotacao_samu == null ? 'd-none' : 'd-flex' }}"
                        style="background-color: transparent; border: none; height: 100px;"
                        readonly>{{$chamado->anotacao_samu}}</textarea>
                    @can('regras','operacao')
                    <div class="input-group mb-3">
                        <input id="id_input_anotacao_{{$chamado->id}}" type="text" class="form-control"
                            style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;"
                            placeholder="Inserir anotação + ENTER para salvar" aria-label="Adicionar anotação"
                            aria-describedby="button-addon2">
                        <button id="id_botao_anotacao_{{$chamado->id}}" class="btn btn-outline-secondary"
                            style="border-radius:0; border-top-right-radius: 5px; border-bottom-right-radius: 5px;"
                            type="button" id="button-addon2">Salvar</button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Situação: </p>
                        <select class="ms-1 form-select" id="id_select_situacao_{{$chamado->id}}">
                            <option value="4" {{ $chamado->situacao == 4 ? 'selected' : '' }}>Cancelado</option>
                            <option value="1" {{ $chamado->situacao == 1 ? 'selected' : '' }}>Aberto</option>
                            <option value="2" {{ $chamado->situacao == 2 ? 'selected' : '' }}>Em andamento</option>
                            <option value="3" {{ $chamado->situacao == 3 ? 'selected' : '' }}>Encerrado</option>
                            @if (!in_array($chamado->situacao, [4, 1, 2, 3]))
                            <option value="-0" selected>Situação inválida</option>
                            @endif
                        </select>
                    </div>
                    @endcan
                    @can('regras','user')
                    <?php
                    switch ($chamado->situacao) {
                        case 4:
                            echo "Situação: Cancelado";
                            break;
                        case 1:
                            echo "Situação: Aberto";
                            break;
                        case 2:
                            echo "Situação: Em andamento";
                            break;
                        case 3:
                            echo "Situação: Encerrado";
                            break;
                        default:
                            echo "Situação: inválida";
                    }
                    ?>
                    @endcan
                    <div title="Descrição automatizada (talvez não seja precisa)">
                        <p>Descrição:</p>
                        <textarea id="id_textarea_descricao_{{$chamado->id}}"
                            style="background-color: transparent; border: none; height: 200px; width:100%;" readonly>
                        @foreach ($chamado->cartao as $cartao)
{{ $cartao->legenda_samu }}
                        @endforeach
                        </textarea>
                    </div>

                </div>
                <div class="card m-1 p-1 <?php echo (count($chamado->foto) > 0) ? 'd-flex' : 'd-none'; ?>"
                    style="background-color: transparent;">
                    <p>Fotos enviadas</p>
                    <div class="d-flex" style="justify-content: space-between;">
                        @foreach ($chamado->foto as $foto)
                        <div class="m-1 p-1">
                            <img class="fotoChamado" style="width:300px;height:200px;border-radius:5px;cursor:zoom-in;"
                                src="{{ asset('/storage/fotos/'.$foto->nome) }}" alt="Foto do Chamado">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="map{{$chamado->id}}" style="height: 300px;" class="card m-1 p-1"
                    style="background-color: transparent;"></div>
            </div>
        </div>
    </div>
</div>