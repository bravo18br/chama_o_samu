<x-app-layout>
    <div class="py-12">
        <div class="card m-1 p-1">
            <div class="accordion" id="accordionExample">
                
                <!-- Accordion Item for Editar cartões existentes -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Editar cartões existentes
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($listas as $nomeLista => $lista)
                            @if ($nomeLista=='cartoes')
                            @foreach ($lista as $cartao)
                            <div style="border:1px solid blue; border-radius:5px;" class="mb-3">
                                <form action="/cartao/{{ $cartao->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row p-1 m-1">
                                        <div class="col-sm-6 p-1 d-flex justify-content-center align-items-center">
                                            <img class="img_cartao" src="{{ asset('/storage/images/' . $cartao->imagem_nome) }}"
                                                alt="{{ $cartao->legenda_user }}" title="Altere a imagem no campo ao lado">
                                        </div>
                                        <div class="col-sm-6 p-1">
                                            <div class="form-group m-1 p-1">
                                                <input type="file" id="foto" name="foto" class="form-control-file" accept="image/*" title="Escolher outra foto">
                                            </div>
                                            <div class="form-group m-1 p-1">
                                                <input type="text" id="legenda_user" name="legenda_user" class="form-control" value="{{ $cartao->legenda_user }}" title="Legenda que será exibida para o USUÁRIO" required>
                                            </div>
                                            <div class="form-group m-1 p-1">
                                                <input type="text" id="legenda_samu" name="legenda_samu" class="form-control" value="{{ $cartao->legenda_samu }}" title="Legenda que será exibida para o SAMU" required>
                                            </div>
                                            <div class="form-group m-1 p-1">
                                                <select id="nivel" name="nivel" class="form-control" title="Selecione o tipo de cartão" required>
                                                    <option value="nivel1" {{ $cartao->nivel == 'nivel1' ? 'selected' : '' }}>Nível 1 - local</option>
                                                    <option value="nivel2" {{ $cartao->nivel == 'nivel2' ? 'selected' : '' }}>Nível 2 - quem</option>
                                                    <option value="nivel3" {{ $cartao->nivel == 'nivel3' ? 'selected' : '' }}>Nível 3 - ferimento</option>
                                                    <option value="raiz" {{ $cartao->nivel == 'raiz' ? 'selected' : '' }}>Raiz</option>
                                                    <option value="voltar" {{ $cartao->nivel == 'voltar' ? 'selected' : '' }}>Voltar</option>
                                                    <option value="foto" {{ $cartao->nivel == 'foto' ? 'selected' : '' }}>Foto</option>
                                                    <option value="avancar" {{ $cartao->nivel == 'avancar' ? 'selected' : '' }}>Avançar</option>
                                                    <option value="cancelar" {{ $cartao->nivel == 'cancelar' ? 'selected' : '' }}>Cancelar</option>
                                                    <option value="registrar" {{ $cartao->nivel == 'registrar' ? 'selected' : '' }}>Registrar</option>
                                                </select>
                                            </div>
                                            <div class="form-group m-1 p-1">
                                                <button type="submit" class="btn btn-primary" title="Salvar as modificações">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="/cartao/{{ $cartao->id }}" method="POST" class="m-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Apagar o cartão">Excluir Cartão</button>
                                </form>
                            </div>
                            @endforeach
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Accordion Item for Criar novo cartão -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Criar novo cartão
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="/cartao" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="form-group m-1 p-1">
                                    <input type="text" id="legenda_user" name="legenda_user" class="form-control" placeholder="Legenda do usuário" required>
                                </div>

                                <div class="form-group m-1 p-1">
                                    <input type="text" id="legenda_samu" name="legenda_samu" class="form-control" placeholder="Legenda do SAMU" required>
                                </div>

                                <div class="form-group m-1 p-1">
                                    <input type="file" id="foto" name="foto" class="form-control-file" accept="image/*" placeholder="Selecione uma foto" required>
                                </div>

                                <div class="form-group m-1 p-1">
                                    <select id="nivel" name="nivel" class="form-control" required>
                                        <option value="">Selecione o tipo de cartão</option>
                                        <option value="nivel1">Nível 1 - local</option>
                                        <option value="nivel2">Nível 2 - quem</option>
                                        <option value="nivel3">Nível 3 - ferimento</option>
                                        <option value="raiz">Raiz</option>
                                        <option value="voltar">Voltar</option>
                                        <option value="foto">Foto</option>
                                        <option value="cancelar">Cancelar</option>
                                        <option value="registrar">Registrar</option>
                                        <option value="salvar">Salvar chamado</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary m-1 p-1">Criar cartão</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Accordion Item for Table users -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Table users
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if (count($listas['users']) == 0)
                            <p>Table vazia</p>
                            @else
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            @foreach (Schema::getColumnListing($listas['users']->first()->getTable()) as $coluna)
                                            <th>{{ $coluna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listas['users'] as $index => $item)
                                        <tr onclick="this.classList.toggle('clicked')">
                                            <td>
                                                @if ($item->deleted_at == null)
                                                <form action="/users" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger" type="submit">X</button>
                                                </form>
                                                @else
                                                <form action="/users" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-primary" type="submit">R</button>
                                                </form>
                                                @endif
                                            </td>
                                            @foreach (Schema::getColumnListing($item->getTable()) as $coluna)
                                            <td>{{ $item->$coluna }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Accordion Item for Table chamados -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Table chamados
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if (count($listas['chamados']) == 0)
                            <p>Table vazia</p>
                            @else
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            @foreach (Schema::getColumnListing($listas['chamados']->first()->getTable()) as $coluna)
                                            <th>{{ $coluna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listas['chamados'] as $index => $item)
                                        <tr onclick="this.classList.toggle('clicked')">
                                            <td>
                                                @if ($item->deleted_at == null)
                                                <form action="/chamados" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger" type="submit">X</button>
                                                </form>
                                                @else
                                                <form action="/chamados" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-primary" type="submit">R</button>
                                                </form>
                                                @endif
                                            </td>
                                            @foreach (Schema::getColumnListing($item->getTable()) as $coluna)
                                            <td>{{ $item->$coluna }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Accordion Item for Table fotos -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Table fotos
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if (count($listas['fotos']) == 0)
                            <p>Table vazia</p>
                            @else
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            @foreach (Schema::getColumnListing($listas['fotos']->first()->getTable()) as $coluna)
                                            <th>{{ $coluna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listas['fotos'] as $index => $item)
                                        <tr onclick="this.classList.toggle('clicked')">
                                            <td>
                                                @if ($item->deleted_at == null)
                                                <form action="/fotos" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger" type="submit">X</button>
                                                </form>
                                                @else
                                                <form action="/fotos" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-primary" type="submit">R</button>
                                                </form>
                                                @endif
                                            </td>
                                            @foreach (Schema::getColumnListing($item->getTable()) as $coluna)
                                            <td>{{ $item->$coluna }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Accordion Item for Table cartoes -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Table cartoes
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if (count($listas['cartoes']) == 0)
                            <p>Table vazia</p>
                            @else
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            @foreach (Schema::getColumnListing($listas['cartoes']->first()->getTable()) as $coluna)
                                            <th>{{ $coluna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listas['cartoes'] as $index => $item)
                                        <tr onclick="this.classList.toggle('clicked')">
                                            <td>
                                                @if ($item->deleted_at == null)
                                                <form action="/cartoes" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger" type="submit">X</button>
                                                </form>
                                                @else
                                                <form action="/cartoes" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-primary" type="submit">R</button>
                                                </form>
                                                @endif
                                            </td>
                                            @foreach (Schema::getColumnListing($item->getTable()) as $coluna)
                                            <td>{{ $item->$coluna }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
