<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;

class Login_edController extends Controller
{
    //
    public function index()
    {
	    $dados = [
	        'page' => 'login_novo',
	    ];
	    return view('template_publico1', $dados);
    }

    public function painel()
    {
    	$user = Auth::user();
        $nivel = $user['nivel'];
        if($user['email_verified_at']!=null)
        {
            switch ($nivel) 
            {
                case 1:
                    return Redirect::to('painel_de_controle/admin');
                    break;
                case 2:
                    return Redirect::to('painel_de_controle/usuarios');  
                    break;
                case 3:
                    return Redirect::to('painel_de_controle/home');  
                    break;
            }//fim Switch
        }
        else
        {
        	return Redirect::to('login');
        }
    }//fechamento painel


}//fim - fechamento Inicial
