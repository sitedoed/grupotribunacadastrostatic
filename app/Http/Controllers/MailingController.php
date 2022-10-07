<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailing;
use App\Cliente;
use App\Feedback;
use DB;
use Auth;
use Session;


class MailingController extends Controller
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
    	$mailings 							= Mailing::paginate(40);
    	$user_id                            = Auth::user()->id;
		$aviso_feedback                     = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'                          => 'admin.admin_mailings',
            'aviso_feedback'				=> $aviso_feedback,
            'mailings'						=> $mailings,
            'resultado'						=> '',
        ];
	    return view ('admin.admin_template2', $dados);  
	}

	public function mailing_listar($id)
	{
		$mailing 							= Mailing::find($id); 
		$mailing_lista 						= Mailing::DadosMailing($id);
		$mailings 							= Mailing::paginate(40);
		$user_id                            = Auth::user()->id;
		$aviso_feedback                     = Feedback::aviso_feedback($user_id);

		$dados = [
			'page' 							=> 'admin.admin_mailing_listar',
			'aviso_feedback'				=> $aviso_feedback,
			'titulo'						=> $mailing->titulo,
			'mailing_lista'					=> $mailing_lista,
			'mailings'						=> $mailings,
		];
		
		return view ('admin.admin_template2', $dados);  

	}

	public function mailing_pesquisar(Request $request)
	{
		$termo 								= $request->mailing_pesquisar;
		$user_id                            = Auth::user()->id;
		$aviso_feedback                     = Feedback::aviso_feedback($user_id);
		$resultado 							= DB::table('dados_mailings')
													->join('mailings', 'mailings.id', '=', 'dados_mailings.mailings_id')
													->select(
															'dados_mailings.id as id',
															'dados_mailings.nome as nome', 
															'dados_mailings.email as email', 
															'mailings.titulo as titulo', 
															'mailings.descricao as descricao'  
													)
													->where('nome', 'like', '%'.$termo.'%')
													->orderBy('id', 'asc')
													->paginate(40);

		$dados = [
			'page' 							=> 'admin.admin_mailing_resultado',
			'resultado'						=> $resultado,
			'termo'							=> $termo,
			'aviso_feedback'				=> $aviso_feedback,
		];

		return view ('admin.admin_template2', $dados); 
	}


}//fechamento Inicio