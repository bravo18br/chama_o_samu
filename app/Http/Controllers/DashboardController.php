<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use App\Models\Chamado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardController()
    {
        $idUsuario = Auth::id();
        $user = User::where('id', $idUsuario)
            ->first();
        $role = $user->role;

        switch ($role) {
            case 1: // 1-superadmin
                return redirect()->route('superadmin');
            case 2: // 2-operacaoSAMU
                return redirect()->route('operacao');
            case 3: // 3-regularUser
                $ultimosChamados = Chamado::where('user_id', $idUsuario)
                    ->whereIn('situacao', [1, 2])
                    ->get();
                if ($ultimosChamados->count() > 0) {
                    return redirect()->route('monitoramento');
                } else {
                    $nivel0 = ['raiz'];
                    $cartoes_nivel0 = Cartao::whereIn('nivel', $nivel0)->get();
                    return view('dashboard')->with(['cartoes_nivel0' => $cartoes_nivel0]);
                }

            case 4: // 4-adminSAMU
                return redirect()->route('samu_admin');
            default:
                echo "Papel não reconhecido.";
                break;
        }
    }
}
