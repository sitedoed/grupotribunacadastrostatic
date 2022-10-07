<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Setor;
use App\Ramal;
use App\User;
use Session;
use App\Quotation;
use Auth;


class PublicoController extends Controller
{
    public function index()
    {
        $dados = [
                'page'      =>  'pesquisa_publico',
                ];
        return view('template_publico', $dados);
    }
     public function pesquisar_publico(Request $request)
    {
        $pesquisar_publico = $request->pesquisar_publico;

        $resultado = DB::table('ramal')
            ->join('setor', 'setor.id', '=', 
                'ramal.setor_id')
            ->select(   'ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
            'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
            ->where('setor', 'like', '%'.$pesquisar_publico.'%')
            ->orWhere('ramal', 'like', '%'.$pesquisar_publico.'%')
            ->orWhere('nome', 'like', '%'.$pesquisar_publico.'%')
            ->where('status', '=', '1')
            ->orderBy('ramal_id', 'asc')
            ->paginate(10);

            $dados = [
                'resultado' => $resultado,
                'page'      => 'pesquisa_publico',
            ];
        
        Session::reflash();

        return view('template_publico2', $dados);
    }

    public function faq()
    {
            $dados = [
                'page'      =>  'faq_nova',
            ];

        return view('template_publico2', $dados);
    }

    public function login()
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

        $dados = [
            'page' => 'login_novo',
        ];

        return view('template_publico3', $dados);

        }

    }

    public function cadastro()
    {
        $dados = [
            'page' => 'cadastro_novo',
        ];

        return view('template_publico3', $dados);
    }

}//fechamento Inicio
