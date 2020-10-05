<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    //
    public function index()
    {
        return view('entrar.index');
    }

    public function entrar(Request $request)
    {
        //$request->email;
        //$request->password;
        if(!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()
                ->back()
                ->withErrors('Usuario ou senha errada');
        }
        return  redirect()->route('listar_series');

    }
}
