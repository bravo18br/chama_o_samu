<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;

state([
    'name' => fn () => auth()->user()->name,
    'email' => fn () => auth()->user()->email,
    'cep' => fn () => auth()->user()->cep,
    'rua' => fn () => auth()->user()->rua,
    'analfabeto' => fn () => auth()->user()->analfabeto,
    'numero' => fn () => auth()->user()->numero,
    'complemento' => fn () => auth()->user()->complemento,
    'celular' => fn () => auth()->user()->celular,
    'cpf' => fn () => auth()->user()->cpf
]);

$updateProfileInformation = function () {
    $user = Auth::user();
    $validated = null;

    $this->cpf = str_replace(['.', '-'], '', $this->cpf);
    $this->cep = str_replace(['.', '-'], '', $this->cep);

    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        'cep' => ['nullable', 'numeric', 'digits:8'],
        'rua' => ['nullable', 'max:255'],
        'numero' => ['nullable', 'max:255'],
        'complemento' => ['nullable', 'max:255'],
        'celular' => ['nullable', 'regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/'],
        'analfabeto' => ['numeric', 'digits:1'],
        'cpf' => ['numeric', 'digits:11']
    ], [
        'name.required' => 'O campo nome é obrigatório.',
        'email.required' => 'O campo email é obrigatório.',
        'cep.numeric' => 'O CEP deve ter apenas números.',
        'cep.digits' => 'O CEP deve ter 8 dígitos.',
        'celular.regex' => 'O celular deve ser no formato: (41) 94545-4545',
        'analfabeto.numeric' => '0 para Não e 1 para Sim',
        'analfabeto.digits' => '0 para Não e 1 para Sim',
        'cpf.numeric' => 'O CPF deve ter apenas números.',
        'cpf.digits' => 'O CPF deve ter 11 dígitos.'
    ]);

    if ($validated !== null) {
        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
};

$sendVerification = function () {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false));

        return;
    }

    $user->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cadastro') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize seus dados cadastrados.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Seu email não foi confirmado') }}

                    <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Clique aqui para reenviar o email de verificação.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
                </p>
                @endif
            </div>
            @endif
        </div>
        <div x-data>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input wire:model="cpf" id="cpf" name="cpf" type="text" class="mt-1 block w-full" autofocus autocomplete="cpf" x-mask="999.999.999-99" placeholder="999.999.999-99" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>
        <div x-data>
            <x-input-label for="cep" :value="__('CEP')" />
            <x-text-input wire:model="cep" id="cep" name="cep" type="text" class="mt-1 block w-full" autofocus autocomplete="cep" x-mask="99.999-999" placeholder="99.999-999"/>
            <x-input-error class="mt-2" :messages="$errors->get('cep')" />
        </div>
        <div>
            <x-input-label for="rua" :value="__('Rua')" />
            <x-text-input wire:model="rua" id="rua" name="rua" type="text" class="mt-1 block w-full" autofocus autocomplete="rua" />
            <x-input-error class="mt-2" :messages="$errors->get('rua')" />
        </div>
        <div>
            <x-input-label for="numero" :value="__('Número')" />
            <x-text-input wire:model="numero" id="numero" name="numero" type="text" class="mt-1 block w-full" autofocus autocomplete="numero" />
            <x-input-error class="mt-2" :messages="$errors->get('numero')" />
        </div>
        <div>
            <x-input-label for="complemento" :value="__('Complemento')" />
            <x-text-input wire:model="complemento" id="complemento" name="complemento" type="text" class="mt-1 block w-full" autofocus autocomplete="complemento" />
            <x-input-error class="mt-2" :messages="$errors->get('complemento')" />
        </div>
        <div x-data>
            <x-input-label for="celular" :value="__('Celular')" />
            <x-text-input wire:model="celular" id="celular" name="celular" type="text" class="mt-1 block w-full" autofocus autocomplete="celular" x-mask="(99) 99999-9999" placeholder="(99) 99999-9999"/>
            <x-input-error class="mt-2" :messages="$errors->get('celular')" />
        </div>

        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="analfabeto" id="btnradio1" wire:model="analfabeto" value="0" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio1">Alfabetizado</label>
            <input type="radio" class="btn-check" name="analfabeto" id="btnradio2" wire:model="analfabeto" value="1" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Analfabeto</label>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('analfabeto')" />

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enviar') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Salvo!') }}
            </x-action-message>
        </div>
    </form>
</section>