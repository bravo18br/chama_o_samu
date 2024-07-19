<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if (count($operadores_lista) > 0)
                <div class="card m-1 p-1">
                    <h2 class="m-1 p-1">Operadores cadastrados</h2>
                    <table class="card m-1 p-1">
                        <tr class="m-1 p-1">
                            <td class="m-1 p-1">ID</td>
                            <td class="m-1 p-1">Nome</td>
                            <td class="m-1 p-1">Email</td>
                            <td class="m-1 p-1">CPF</td>
                            <td class="m-1 p-1">Remover</td>
                        </tr>
                        @foreach ($operadores_lista as $operator)
                        <tr class="m-1 p-1">
                            <td class="m-1 p-1">{{ $operator->id }}</td>
                            <td class="m-1 p-1">{{ $operator->name }}</td>
                            <td class="m-1 p-1">{{ $operator->email }}</td>
                            <td class="m-1 p-1">{{ $operator->cpf }}</td>
                            <td>
                                <form action="/samu_admin" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="email" value="{{ $operator->email }}">
                                    <button class="btn btn-danger" type="submit">X</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <h2 class="card m-1 p-1">Não exitem operadores cadastrados</h2>
                    @endif
                </div>
                <div class="card m-1 p-1" title="Para converter um registro em operador, insira o CPF ou email e clique em inserir">
                    <h2 class="m-1 p-1">Cadastrar Novo Operador</h2>
                    <table class="card m-1 p-1">
                        <tr class="m-1 p-1">
                            <td>
                                <form action="/samu_admin" method="POST">
                                    <div class="input-group m-1 p-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" name="cpf" placeholder="CPF" aria-label="CPF" aria-describedby="button-addon2" style=" border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Inserir</button>
                                    </div>

                                    @if($errors->has('cpf'))
                                    <div class="alert alert-danger error-message d-flex">
                                        {{ $errors->first('cpf') }}
                                    </div>
                                    @endif

                                </form>
                            </td>

                        </tr>
                        <tr class="m-1 p-1">
                            <td>
                                <form action="/samu_admin" method="POST">
                                    <div class="input-group m-1 p-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" name="email" placeholder="Email" aria-label="email" aria-describedby="button-addon2" style=" border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Inserir</button>
                                    </div>

                                    @if($errors->has('email'))
                                    <div class="alert alert-danger error-message d-flex">
                                        {{ $errors->first('email') }}
                                    </div>
                                    @endif

                                </form>
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.querySelectorAll('.error-message')
            if (errorMessage.length > 0) {
                for (const erro of errorMessage) {
                    setTimeout(function() {
                        erro.classList.remove('d-flex')
                        erro.classList.add('d-none')
                    }, 10 * 1000);
                }
            }
        });
    </script>

</x-app-layout>