<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->id;
        User::find($id)->delete();
        return back();
    }
    public function restaura(Request $request)
    {
        User::withTrashed()
            ->find($request->id)
            ->restore();
        return back();
    }
}
