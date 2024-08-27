@if (count($listas['fotos']) == 0)
<div class="card p-3">
    <p class="fs-2">Table vazia</p>
</div>
@else

<!-- Table fotos -->
<div class="card pt-3 px-1">
    <table class="table table-sm table-hover table-bordered">
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
                    <img src="{{ asset('/storage/fotos/'.$item->nome) }}" alt="Miniatura" style="width: 100px; height: 100px;">
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
