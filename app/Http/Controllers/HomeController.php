<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use App\Models\facturas;
use App\Models\usuario;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth()-> user()['email'];
        $objeto_validar = usuario::where('email',$user)->get();
        if (count($objeto_validar) > 0) {
            if ($objeto_validar[0]['rol_user'] !== '0') {
                $data = productos::all();
                    return view('inicio',compact('data'));
            }else{
                $data = facturas::all();
                return view('admin',compact('data'));
            }
        }
    }
    public function getrespuesta()
    {
        return view('compra_completa');
    }
    
}
