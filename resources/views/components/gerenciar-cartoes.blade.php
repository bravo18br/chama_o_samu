@if (count($listas['cartoes']) == 0)
<div class="card p-3">
    <p class="fs-2">Table vazia</p>
</div>
@else

<!-- Table cartoes -->
<div class="card pt-3 px-1">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th>
                    <!-- Botão para criar um novo cartão -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCartaoModal">Novo</button>
                </th>
                @foreach (Schema::getColumnListing($listas['cartoes']->first()->getTable()) as $coluna)
                <th>{{ $coluna }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($listas['cartoes'] as $index => $item)
            <tr onclick="this.classList.toggle('clicked')">
                <td class="d-flex">
                    <!-- Botão para abrir o modal de edição de cartão -->
                    <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editCartaoModal{{ $item->id }}" title="Editar registro">E</button>

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
