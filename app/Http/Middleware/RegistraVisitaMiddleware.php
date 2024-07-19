<?php

namespace App\Http\Middleware;

use App\Models\Visita;
use Closure;
use Illuminate\Http\Request;

class RegistraVisitaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        Visita::create([
            'user_id' => auth()->id(),
            'rota' => $request->path()
        ]);
        return $response;
    }
}

