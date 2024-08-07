<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Livewire\Volt\layout;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'analfabeto' => '0',
    'password' => '',
    'password_confirmation' => '',
    'cpf' => ''
]);

$register = function () {
    $validated = $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|lowercase|email|max:255|unique:users',
        'password' => 'required|string|confirmed',
        'cpf' => 'required|numeric|digits:11|unique:users',
        'analfabeto' => 'required|numeric|digits:1|in:0,1'
    ], [
        'name.required' => 'O campo nome é obrigatório.',
        'email.required' => 'O campo email é obrigatório.',
        'email.unique' => 'Esse email já está cadastrado. Tente recuperar a senha.',
        'cpf.required' => 'O campo cpf é obrigatório.',
        'cpf.numeric' => 'O campo cpf deve ter apenas números.',
        'cpf.digits' => 'O campo cpf deve ter 11 números.',
        'cpf.unique' => 'Esse cpf já está cadastrado, tente recuperar a senha.',
        'password.required' => 'O campo senha é obrigatório.',
        'analfabeto.required' => 'O campo analfabeto é obrigatório.',
        'analfabeto.numeric' => 'Zero (0) para Não e um (1) para Sim',
        'analfabeto.digits' => 'Zero (0) para Não e um (1) para Sim',
        'analfabeto.in' => 'O campo analfabeto deve ser 0 para Não ou 1 para Sim',
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
