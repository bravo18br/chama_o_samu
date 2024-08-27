<x-app-layout>
    <div class="d-flex align-items-start mt-5">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-users-tab" data-bs-toggle="pill" data-bs-target="#v-pills-users" type="button" role="tab" aria-controls="v-pills-users" aria-selected="true">Users</button>
            <button class="nav-link" id="v-pills-chamados-tab" data-bs-toggle="pill" data-bs-target="#v-pills-chamados" type="button" role="tab" aria-controls="v-pills-chamados" aria-selected="false">Chamados</button>
            <button class="nav-link" id="v-pills-fotos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-fotos" type="button" role="tab" aria-controls="v-pills-fotos" aria-selected="false">Fotos</button>
            <button class="nav-link" id="v-pills-cartoes-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cartoes" type="button" role="tab" aria-controls="v-pills-cartoes" aria-selected="false">Cartões</button>
        </div>
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab" tabindex="0"><x-gerenciar-users></x-gerenciar-users></div>
            <div class="tab-pane fade" id="v-pills-chamados" role="tabpanel" aria-labelledby="v-pills-chamados-tab" tabindex="0"><x-gerenciar-chamados></x-gerenciar-chamados></div>
            <div class="tab-pane fade" id="v-pills-fotos" role="tabpanel" aria-labelledby="v-pills-fotos-tab" tabindex="0"><x-gerenciar-fotos></x-gerenciar-fotos></div>
            <div class="tab-pane fade" id="v-pills-cartoes" role="tabpanel" aria-labelledby="v-pills-cartoes-tab" tabindex="0"><x-gerenciar-cartoes></x-gerenciar-cartoes></div>
        </div>
    </div>

    <div>
        @error('error')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
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
