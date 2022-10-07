<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

        $email = Auth::user()->email;
        Mail::to($email)->send(new DemoMail());
        //return view('home');


/*
        $nivel = Auth::user()->nivel;

            if($nivel==1){
                //return view ('admin.admin_template', $dados);
                return "Administrador"; 
            }else if($nivel==2){
                //return Redirect::to('painel_de_controle/usuarios/urnconfig'); 
                return "Usuário";
            }else{
                //return Redirect::to('painel_de_controle/clientes');     
                return "Cliente"; 
            }
*/

    }
}
