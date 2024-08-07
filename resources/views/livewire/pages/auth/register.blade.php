<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function Livewire\Volt\layout;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'analfabeto' => '0',
    'password' => '',
    'password_confirmation' => '',
    'cpf' => '',
    'cep' => '',
    'rua' => '',
    'numero' => '',
    'complemento' => '',
    'celular' => ''
]);

$register = function () {
    $this->cpf = preg_replace('/\D/', '', $this->cpf);
    $this->cep = str_replace(['.', '-'], '', $this->cep);
    $validated = $this->validate([
        'analfabeto' => 'required|numeric|digits:1|in:0,1',
        'celular' => 'nullable|regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
        'cep' => 'nullable|numeric|digits:8',
        'complemento' => 'nullable|max:255',
        'cpf' => 'required|numeric|digits:11|unique:users',
        'email' => 'required|string|lowercase|email|max:255|unique:users',
        'name' => 'required|string|max:255',
        'numero' => 'nullable|max:255',
        'password' => 'required|string|confirmed',
        'rua' => 'nullable|max:255',
    ], [
        'analfabeto.required' => 'O campo analfabeto é obrigatório.',
        'analfabeto.numeric' => 'Zero (0) para Não e um (1) para Sim',
        'analfabeto.digits' => 'Zero (0) para Não e um (1) para Sim',
        'analfabeto.in' => 'O campo analfabeto deve ser 0 para Não ou 1 para Sim',
        'celular.regex' => 'O celular deve ser no formato: (41) 94545-4545',
        'cep.numeric' => 'O CEP deve ter apenas números.',
        'cep.digits' => 'O CEP deve ter 8 dígitos.',
        'cpf.required' => 'O campo cpf é obrigatório.',
        'cpf.numeric' => 'O campo cpf deve ter apenas números.',
        'cpf.digits' => 'O campo cpf deve ter 11 números.',
        'cpf.unique' => 'Esse cpf já está cadastrado, tente recuperar a senha.',
        'email.required' => 'O campo email é obrigatório.',
        'email.unique' => 'Esse email já está cadastrado. Tente recuperar a senha.',
        'name.required' => 'O campo nome é obrigatório.',
        'password.required' => 'O campo senha é obrigatório.',
    ]);

    $validated['password'] = Hash::make($validated['password']);
    event(new Registered($user = User::create($validated)));
    Auth::login($user);
    $this->redirect(route('dashboard', absolute: false), navigate: true);
};
?>

<div>
    <form wire:submit="register">
        <div class="d-flex justify-content-center align-items-center">
            <p>Registrar Novo Usuário</p>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4" x-data>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input wire:model="cpf" id="cpf" class="block mt-1 w-full" type="text" name="cpf" required autofocus autocomplete="cpf" x-mask="999.999.999-99" placeholder="999.999.999-99" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- CEP -->
        <div class="mt-4" x-data>
            <x-input-label for="cep" :value="__('CEP')" />
            <x-text-input wire:model="cep" id="cep" name="cep" type="text" class="mt-1 block w-full" autofocus autocomplete="cep" x-mask="99.999-999" placeholder="99.999-999"/>
            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
        </div>

        <!-- RUA -->
        <div class="mt-4" x-data>
            <x-input-label for="rua" :value="__('Rua')" />
            <x-text-input wire:model="rua" id="rua" name="rua" type="text" class="mt-1 block w-full" autofocus autocomplete="rua" />
            <x-input-error :messages="$errors->get('rua')" class="mt-2" />
        </div>

        <!-- NUMERO -->
        <div class="mt-4" x-data>
            <x-input-label for="numero" :value="__('Número')" />
            <x-text-input wire:model="numero" id="numero" name="numero" type="text" class="mt-1 block w-full" autofocus autocomplete="numero" />
            <x-input-error :messages="$errors->get('numero')" class="mt-2" />
        </div>

        <!-- COMPLEMENTO -->
        <div class="mt-4" x-data>
            <x-input-label for="complemento" :value="__('Complemento')" />
            <x-text-input wire:model="complemento" id="complemento" name="complemento" type="text" class="mt-1 block w-full" autofocus autocomplete="complemento" />
            <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
        </div>

        <!-- CELULAR -->
        <div class="mt-4" x-data>
            <x-input-label for="celular" :value="__('Celular')" />
            <x-text-input wire:model="celular" id="celular" name="celular" type="text" class="mt-1 block w-full" autofocus autocomplete="celular" x-mask="(99) 99999-9999" placeholder="(99) 99999-9999"/>
            <x-input-error :messages="$errors->get('celular')" class="mt-2" />
        </div>

        <!-- ALFABETIZADO -->
        <div class="mt-4 text-center">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="analfabeto" id="btnradio1" wire:model="analfabeto" value="0" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio1">Alfabetizado</label>
                <input type="radio" class="btn-check" name="analfabeto" id="btnradio2" wire:model="analfabeto" value="1" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Analfabeto</label>
            </div>
        </div>

        <div class="flex items-center justify-center mt-4">
            <div class="block">
                <div><a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                        {{ __('Já é registrado?') }}
                    </a></div>
                <div><a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('home') }}" wire:navigate>
                        {{ __('Voltar') }}
                    </a></div>
            </div>
            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</div>
