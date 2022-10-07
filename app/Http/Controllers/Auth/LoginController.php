<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function showLoginForm()
{
    $dados = [
        'page' => 'login_novo',
    ];
    return view('template_publico1', $dados);
}

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //Método original
    //protected $redirectTo = '/home';

//Método Novo
    protected function redirectTo()
    {
        $user = Auth::user();
        $nivel = $user['nivel'];
        if($user['email_verified_at']!=null)
        {
            switch ($nivel) 
            {
                case 1:
                    return 'painel_de_controle/admin';  
                    break;
                case 2:
                    return 'painel_de_controle/usuarios';  
                    break;
                case 3:
                    return 'painel_de_controle/clientes/home';  
                    break;
            }//fim Switch
        }
      //  return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function acesso_restrito()
    {
        Return view( 'acesso_restrito');
    }

}//fechamento inicial

