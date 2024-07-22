<x-app-layout>
    <div class="margin-top">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                @if(auth()->check())
                    @if(auth()->user()->role == 1)
                    @include('superadmin')
                    @elseif(auth()->user()->role == 2)
                    @include('samuAdm')
                    @elseif(auth()->user()->role == 3)
                    @include('usuarioAdm')
                    @endif
                @else
                <p>Usuário não autenticado</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>