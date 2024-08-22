<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class AuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Depurando os dados do usuário
            dd($user);

        } catch (\Exception $e) {
            Log::channel('integrado')->error('AuthGoogleController: ' . $e->getMessage());
            return view('error404');
        }
    }

}
