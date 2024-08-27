@if (count($listas['users']) == 0)
<div class="card p-3">
    <p class="fs-2">Table vazia</p>
</div>
@else

<!-- Table users -->
<div class="card pt-3 px-1">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th>
                    <!-- Botão para criar um novo user -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">Novo</button>
                </th>
                @foreach (Schema::getColumnListing($listas['users']->first()->getTable()) as $coluna)
                <th>{{ $coluna }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($listas['users'] as $index => $item)
            <tr onclick="this.classList.toggle('clicked')">
                <td class="d-flex">
                    <!-- Botão para abrir o modal de edição de usuários -->
                    <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}" title="Editar registro">E</button>

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
