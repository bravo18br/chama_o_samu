<x-app-layout>
    <div class="py-12">
        <div class="card m-1 p-1">
            <div class="accordion" id="accordionExample">

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
                                            <th>
                                                <!-- Botão para criar um novo user -->
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">Criar novo</button>
                                            </th>
                                            @foreach (Schema::getColumnListing($listas['users']->first()->getTable()) as $coluna)
                                            <th>{{ $coluna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listas['users'] as $index => $item)
                                        <tr onclick="this.classList.toggle('clicked')">
                                            <td>
                                                <!-- Botão para abrir o modal de edição de usuários -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}" title="Editar registro">E</button>

                                                <!-- Formulário para excluir o usuário -->
                                                @if ($item->deleted_at == null)
                                                <form action="/users/{{ $item->id }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger" type="submit" title="Excluir registro">X</button>
                                                </form>
                                                @else
                                                <form action="/users/restore/{{ $item->id }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-warning" type="submit" title="Restaurar registro">R</button>
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
                                                    <button class="btn btn-danger" type="submit" title="Excluir registro">X</button>
                                                </form>
                                                @else
                                                <form action="/chamados" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-warning" type="submit" title="Restaurar registro">R</button>
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
                                            <th>tumb</th>
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
                                                    <button class="btn btn-danger" type="submit" title="Excluir registro">X</button>
                                                </form>
                                                @else
                                                <form action="/fotos" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-warning" type="submit" title="Restaurar registro">R</button>
                                                </form>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/fotos/'.$item->nome) }}" alt="Miniatura" style="width: 100px; height: 100px;">
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
                                            <th>
                                                <!-- Botão para criar um novo cartão -->
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCartaoModal">Criar novo</button>
                                            </th>
                                            @foreach (Schema::getColumnListing($listas['cartoes']->first()->getTable()) as $coluna)
                                            <th>{{ $coluna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listas['cartoes'] as $index => $item)
                                        <tr onclick="this.classList.toggle('clicked')">
                                            <td>
                                                <!-- Botão para abrir o modal de edição de cartão -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCartaoModal{{ $item->id }}" title="Editar registro">E</button>

                                                <!-- Formulário para excluir o cartão -->
                                                @if ($item->deleted_at == null)
                                                <form action="/cartao/{{ $item->id }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger" type="submit" title="Excluir registro">X</button>
                                                </form>
                                                @else
                                                <form action="/cartao/restore/{{ $item->id }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-warning" type="submit" title="Restaurar registro">R</button>
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

                <!-- Modal para criar novo cartão -->
                <div class="modal fade" id="createCartaoModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Criar Novo Cartão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/cartao" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="new_legenda_user" class="form-label">Legenda do Usuário</label>
                                        <input type="text" class="form-control" id="new_legenda_user" name="legenda_user" required>
                                        @error('legenda_user')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_legenda_samu" class="form-label">Legenda do SAMU</label>
                                        <input type="text" class="form-control" id="new_legenda_samu" name="legenda_samu" required>
                                        @error('legenda_samu')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="new_foto" name="foto" accept="image/*" required>
                                        @error('foto')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_nivel" class="form-label">Nível</label>
                                        <select id="new_nivel" name="nivel" class="form-control" required>
                                            <option value="nivel1">Nível 1 - local</option>
                                            <option value="nivel2">Nível 2 - quem</option>
                                            <option value="nivel3">Nível 3 - ferimento</option>
                                            <option value="raiz">Raiz</option>
                                            <option value="voltar">Voltar</option>
                                            <option value="foto">Foto</option>
                                            <option value="avancar">Avançar</option>
                                            <option value="cancelar">Cancelar</option>
                                            <option value="registrar">Registrar</option>
                                        </select>
                                        @error('nivel')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Criar Cartão</button>
                                    @if(session('showModal')=='createCartaoModal')
                                    @if(session('erro'))
                                    <div class="alert alert-danger m-1">
                                        {{ session('erro') }}
                                    </div>
                                    @endif
                                    @if(session('sucesso'))
                                    <div class="alert alert-success m-1">
                                        {{ session('sucesso') }}
                                    </div>
                                    @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para criar novo user -->
                <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Criar Novo User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/users" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Superadmin</option>
                                            <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Operador SAMU</option>
                                            <option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Regular User</option>
                                            <option value="4" {{ old('role') == 4 ? 'selected' : '' }}>Admin SAMU</option>
                                        </select>
                                        @error('role')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="analfabeto" class="form-label">Analfabeto</label>
                                        <select class="form-control" id="analfabeto" name="analfabeto" required>
                                            <option value="0" {{ old('analfabeto') == 0 ? 'selected' : '' }}>Não</option>
                                            <option value="1" {{ old('analfabeto') == 1 ? 'selected' : '' }}>Sim</option>
                                        </select>
                                        @error('analfabeto')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        @error('password')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirme a Senha</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                        @error('password_confirmation')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
                                        @error('cpf')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}">
                                        @error('cep')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rua" class="form-label">Rua</label>
                                        <input type="text" class="form-control" id="rua" name="rua" value="{{ old('rua') }}">
                                        @error('rua')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}">
                                        @error('numero')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento') }}">
                                        @error('complemento')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular') }}">
                                        @error('celular')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Criar Usuário</button>
                                    @if(session('showModal')=='createUserModal')
                                    @if(session('erro'))
                                    <div class="alert alert-danger m-1">
                                        {{ session('erro') }}
                                    </div>
                                    @endif
                                    @if(session('sucesso'))
                                    <div class="alert alert-success m-1">
                                        {{ session('sucesso') }}
                                    </div>
                                    @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de edição de users -->
                @foreach ($listas['users'] as $index => $item)
                <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Editar User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/users/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name{{ $item->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                                        @error('name')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email{{ $item->id }}" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email{{ $item->id }}" name="email" value="{{ $item->email }}" required>
                                        @error('email')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="role{{ $item->id }}" class="form-label">Role</label>
                                        <select class="form-control" id="role{{ $item->id }}" name="role" required>
                                            <option value="1" {{ $item->role == 1 ? 'selected' : '' }}>Superadmin</option>
                                            <option value="2" {{ $item->role == 2 ? 'selected' : '' }}>Operador SAMU</option>
                                            <option value="3" {{ $item->role == 3 ? 'selected' : '' }}>Regular User</option>
                                            <option value="4" {{ $item->role == 4 ? 'selected' : '' }}>Admin SAMU</option>
                                        </select>
                                        @error('role')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="analfabeto{{ $item->id }}" class="form-label">Analfabeto</label>
                                        <select class="form-control" id="analfabeto{{ $item->id }}" name="analfabeto" required>
                                            <option value="0" {{ $item->analfabeto == 0 ? 'selected' : '' }}>Não</option>
                                            <option value="1" {{ $item->analfabeto == 1 ? 'selected' : '' }}>Sim</option>
                                        </select>
                                        @error('analfabeto')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password{{ $item->id }}" class="form-label">Forçar nova senha</label>
                                        <input type="password" class="form-control" id="password{{ $item->id }}" name="password">
                                        @error('password')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="cpf{{ $item->id }}" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf{{ $item->id }}" name="cpf" value="{{ $item->cpf }}" required>
                                        @error('cpf')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="cep{{ $item->id }}" class="form-label">CEP</label>
                                        <input type="text" class="form-control" id="cep{{ $item->id }}" name="cep" value="{{ $item->cep }}">
                                        @error('cep')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rua{{ $item->id }}" class="form-label">Rua</label>
                                        <input type="text" class="form-control" id="rua{{ $item->id }}" name="rua" value="{{ $item->rua }}">
                                        @error('rua')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="numero{{ $item->id }}" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero{{ $item->id }}" name="numero" value="{{ $item->numero }}">
                                        @error('numero')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="complemento{{ $item->id }}" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento{{ $item->id }}" name="complemento" value="{{ $item->complemento }}">
                                        @error('complemento')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="celular{{ $item->id }}" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celular{{ $item->id }}" name="celular" value="{{ $item->celular }}">
                                        @error('celular')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    @if(session('showModal')=='editUserModal'.$item->id)
                                    @if(session('erro'))
                                    <div class="alert alert-danger m-1">
                                        {{ session('erro') }}
                                    </div>
                                    @endif
                                    @if(session('sucesso'))
                                    <div class="alert alert-success m-1">
                                        {{ session('sucesso') }}
                                    </div>
                                    @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Modal de edição de cartões -->
                @foreach ($listas['cartoes'] as $index => $item)
                <div class="modal fade" id="editCartaoModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Editar Cartão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/cartao/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="legenda_user_{{ $item->id }}" class="form-label">Legenda do Usuário</label>
                                        <input type="text" class="form-control" id="legenda_user_{{ $item->id }}" name="legenda_user" value="{{ $item->legenda_user }}" required>
                                        @error('legenda_user')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="legenda_samu_{{ $item->id }}" class="form-label">Legenda do SAMU</label>
                                        <input type="text" class="form-control" id="legenda_samu_{{ $item->id }}" name="legenda_samu" value="{{ $item->legenda_samu }}" required>
                                        @error('legenda_samu')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto_{{ $item->id }}" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="foto_{{ $item->id }}" name="foto" accept="image/*">
                                        @error('foto')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nivel_{{ $item->id }}" class="form-label">Nível</label>
                                        <select id="nivel_{{ $item->id }}" name="nivel" class="form-control" required>
                                            <option value="nivel1" {{ $item->nivel == 'nivel1' ? 'selected' : '' }}>Nível 1 - local</option>
                                            <option value="nivel2" {{ $item->nivel == 'nivel2' ? 'selected' : '' }}>Nível 2 - quem</option>
                                            <option value="nivel3" {{ $item->nivel == 'nivel3' ? 'selected' : '' }}>Nível 3 - ferimento</option>
                                            <option value="raiz" {{ $item->nivel == 'raiz' ? 'selected' : '' }}>Raiz</option>
                                            <option value="voltar" {{ $item->nivel == 'voltar' ? 'selected' : '' }}>Voltar</option>
                                            <option value="foto" {{ $item->nivel == 'foto' ? 'selected' : '' }}>Foto</option>
                                            <option value="avancar" {{ $item->nivel == 'avancar' ? 'selected' : '' }}>Avançar</option>
                                            <option value="cancelar" {{ $item->nivel == 'cancelar' ? 'selected' : '' }}>Cancelar</option>
                                            <option value="registrar" {{ $item->nivel == 'registrar' ? 'selected' : '' }}>Registrar</option>
                                        </select>
                                        @error('nivel')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    @if(session('showModal')=='editCartaoModal'.$item->id)
                                    @if(session('erro'))
                                    <div class="alert alert-danger m-1">
                                        {{ session('erro') }}
                                    </div>
                                    @endif
                                    @if(session('sucesso'))
                                    <div class="alert alert-success m-1">
                                        {{ session('sucesso') }}
                                    </div>
                                    @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    @if(session('showModal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalId = `{{ session('showModal') }}`;
            var myModal = new bootstrap.Modal(document.getElementById(modalId), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
    @endif

    <x-busca-via-c-e-p />
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
