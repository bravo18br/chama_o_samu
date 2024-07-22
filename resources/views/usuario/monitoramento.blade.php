<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="card m-1 p-1" style="border: solid black 2px;">
                    <h1>PAGINA DE MONITORAMENTO</h1>
                </div>
                @if ($chamado===null)
                <h1>Não existem chamados registrados nessa conta</h1>
                @else
                <div class="card m-1 p-1" style="background-color: transparent;">
                    <p>Solicitante</p>
                    <p>Nome: {{$chamado->user->name}}</p>
                    <p>Email: {{$chamado->user->email}}</p>
                    @if (!$chamado->user->role==3)
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
                    @endif
                    <p>Analfabeto: {{ $chamado->user->analfabeto == 1 ? 'Sim' : 'Não' }}</p>
                    @php
                    $formataExibicao = new App\Helpers\FormataExibicao;
                    @endphp
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
                    <p id="chamado_id" data-id="{{$chamado->id}}">Chamado ID: {{$chamado->id}}</p>
                    <p>Abertura: {{ $formataExibicao->data_hora($chamado->created_at) }}</p>
                    <p title="Localização automática (talvez não seja precisa)">Geolocalização: {{$chamado->geolocalizacao}}</p>
                    <p id="id_latitude_value_{{$chamado->id}}" class="d-none" value="{{ $chamado->latitude }}"></p>
                    <p id="id_longitude_value_{{$chamado->id}}" class="d-none" value="{{ $chamado->longitude }}"></p>
                    <p class="{{ $chamado->user->role==3 && $chamado->anotacao_samu == null ? 'd-none' : 'd-flex' }}">Anotação SAMU:</p>
                    <textarea id="id_textarea_anotacao" class="{{ $chamado->anotacao_samu == null ? 'd-none' : 'd-flex' }}" style="background-color: transparent; border: none; height: 100px;" readonly>{{$chamado->anotacao_samu}}</textarea>
                    @if (!$chamado->user->role==3)
                    <div class="input-group mb-3">
                        <input id="id_input_anotacao" type="text" class="form-control" style=" border-top-left-radius: 5px; border-bottom-left-radius: 5px;" placeholder="Inserir anotação + ENTER para salvar" aria-label="Adicionar anotação" aria-describedby="button-addon2">
                        <button id="id_botao_anotacao" class="btn btn-outline-secondary" style="border-radius:0; border-top-right-radius: 5px; border-bottom-right-radius: 5px;" type="button" id="button-addon2">Salvar</button>
                    </div>
                    @endif
                    @if ($chamado->user->role==3)
                    <p id="id_chamado_situacao" class="d-none" value="{{$chamado->situacao}}"></p>
                    @endif
                    @if (!$chamado->user->role==3)
                    <div class="d-flex justify-content-center align-items-center">
                        <p id="id_chamado_situacao" value="{{$chamado->situacao}}">Situação: </p>
                        <select class="ms-1 form-select" id="id_select_situacao">
                            <option value="4" {{ $chamado->situacao == 4 ? 'selected' : '' }}>Cancelado</option>
                            <option value="1" {{ $chamado->situacao == 1 ? 'selected' : '' }}>Aberto</option>
                            <option value="2" {{ $chamado->situacao == 2 ? 'selected' : '' }}>Em andamento</option>
                            <option value="3" {{ $chamado->situacao == 3 ? 'selected' : '' }}>Encerrado</option>
                            @if (!in_array($chamado->situacao, [4, 1, 2, 3]))
                            <option value="-0" selected>Situação inválida</option>
                            @endif
                        </select>
                    </div>
                    @else
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
                    @endif
                    <div title="Descrição automatizada (talvez não seja precisa)">
                        <p>Descrição:</p>
                        <textarea style="background-color: transparent; border: none; height: 150px; width:100%;" readonly>
@foreach ($chamado->cartao as $cartao){{ $cartao->legenda_samu }}
@endforeach
                        </textarea>
                    </div>

                </div>
                @if ($chamado->foto->count()>0)
                <div class="card m-1 p-1" style="background-color: transparent;">
                    <p>Fotos enviadas</p>
                    <div class="d-flex" style="justify-content: space-between;">
                        @foreach ($chamado->foto as $foto)
                        <div class="m-1 p-1">
                            <img class="fotoChamado" style="width:300px;height:200px;border-radius:5px;cursor:zoom-in;" src="{{ asset('/storage/fotos/'.$foto->nome) }}" alt="Foto do Chamado">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div id="map{{$chamado->id}}" style="height: 300px;" class="card m-1 p-1" style="background-color: transparent;">
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
