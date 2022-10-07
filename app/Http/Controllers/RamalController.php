<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Setor;
use App\Ramal;
use App\User;
use App\Feedback;
use Session;
use App\Quotation;
use Auth;

class RamalController extends Controller
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
        return view('pesquisa');
    }

    public function pesquisar_publico(Request $request)
    {
        $pesquisar_publico      = $request->pesquisar_publico;
        $resultado              = Ramal::pesquisar_publico($pesquisar_publico);
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados = [
            'resultado'         => $resultado,
            'page'              =>  'pesquisa',
            'aviso_feedback'    => $aviso_feedback,
        ];

        return view('pesquisa', $dados);
    }

    public function admin_pesquisar_ramal(Request $request)
    {
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);
        $pesquisar_ramal        = $request->pesquisar_ramal;
        $status                 = $request->status;
        $ramais                 = Ramal::ramais_setores();
        
        if($pesquisar_ramal=="")
        {
            $resultado = Ramal::ramal_por_status($status);
        }else{
            $resultado = Ramal::ramal_like_pesquisar_ramal($pesquisar_ramal, $status);
        }

        $dados = [
            'resultado'         => $resultado,
            'total'             => $resultado->total(),
            'status'            => $status,
            'page'              => 'admin.admin_ramais_resultado',
            'setores'           => Setor::All(),
            'ramais'            => $ramais,
            'aviso_feedback'    => $aviso_feedback,
        ];

        return view('admin.admin_template2', $dados);
    }

    public function usuarios_pesquisar_ramal(Request $request)
    {
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);
        $pesquisar_ramal        = $request->pesquisar_ramal;
        $status                 = $request->status;
        $ramais                 = Ramal::ramais_setores();
        
        if($pesquisar_ramal=="")
        {
            $resultado = Ramal::ramal_por_status($status);
        }else{
            $resultado = Ramal::ramal_like_pesquisar_ramal($pesquisar_ramal, $status);
        }

        $dados = [
            'resultado'         => $resultado,
            'total'             => $resultado->total(),
            'status'            => $status,
            'page'              => 'usuarios.usuarios_ramais_resultado',
            'setores'           => Setor::All(),
            'ramais'            => $ramais,
            'aviso_feedback'    => $aviso_feedback,
        ];

        return view('usuarios.usuarios_template2', $dados);
    }


    public function ramais()
    {
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);
        $setores                = Setor::All();
        $ramais                 = Ramal::ramais_setores();

        $dados = [
            'page'              => 'admin.admin_ramais',
            'setores'           => $setores,
            'ramais'            => $ramais,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);
    }    

    public function ramal_cadastrar(Request $request)
    {
        $ramal                  = new Ramal();
        $ramal_cadastrar        =   DB::table('ramal')->insert([
                                                            'ramal'     => $request['ramal'],
                                                            'nome'      => $request['nome'],
                                                            'status'    => $request['status'],
                                                            'setor_id'  => $request['setor_id'], 
                                                        ]);
        $ramais                 = Ramal::All();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados = [
            'page'              => 'ramais',
            'ramais'            => $ramais,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return Redirect::to('painel_de_controle/admin/ramais')->with('success', 'Ramal cadastrado com Sucesso');
    }

    public function ramal_editar($id)
    {
        $ramal                  = Ramal::ramal_por_id($id);
        $ramais                 = Ramal::ramais_setores();
        $setores                = Setor::ALl();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);         

        $dados=[
            'page'              => 'admin.admin_ramais',
            'ramal'             => $ramal,
            'ramais'            => $ramais,
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);
    }

    public function ramal_atualizar($id, Request $request)
    {
        $ramal                  = Ramal::findOrFail($id);
        $ramal                  ->update($request->all());

        return Redirect::to('painel_de_controle/admin/'.$id.'/ramal_editar/')->with('success', 'Ramal atualizado com sucesso!!!' );
    }

    public function ramal_aviso_deletar($id)
    {
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este ramal, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');

        $ramal                  = Ramal::ramal_por_id($id);
        $ramais                 = Ramal::ramais_setores();
        $setores                = Setor::All();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);        

        $dados=[
            'page'              => 'admin.admin_ramais',
            'ramal'             => $ramal,
            'ramais'            => $ramais,
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);
    }

    public function ramal_deletar($id)
    {
        $ramal                  = Ramal::findOrFail($id);   
        $ramal                  ->delete();

        \Session::flash('Ramal excluído com Sucesso');

       return Redirect::to('painel_de_controle/admin/ramais')->with('danger', 'Ramal excluído com Sucesso');
    }

    public function setores()
    {
        $setores                = Setor::paginate(10);
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);
                                
        $dados = [
            'page'              => 'admin.admin_setores',
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);
    }

    public function setor_cadastrar(Request $request)
    {
        $setor                  = new Setor();
        $setor_cadastrar        = DB::table('setor')->insert([
                                                        'setor' => $request['setor'], 
                                                    ]);
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados = [
            'page'              => 'setores',
            'aviso_feedback'    => $aviso_feedback,
        ];

        return Redirect::to('setores')->with('success', 'Setor criado com sucesso!!!' ); 
    } 
        public function setor_editar($id, Request $request)
    {
        $setor                  = Setor::setor_por_id($id);
        $setores                = Setor::paginate(10);
        $user_id                = Auth::user()->id;
        $aviso_feedback         =  Feedback::aviso_feedback($user_id);

        $dados = [
            'page'              => 'admin.admin_setores',
            'setor'             => $setor,
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];

        return view('admin.admin_template2', $dados);

    } 

    public function setor_atualizar($id, Request $request)
    {
        $setor                  = Setor::findOrFail($id);
        $setor                  ->update($request->all());

        return Redirect::to('painel_de_controle/admin/setores')->with('success', 'Setor atualizado com sucesso!!!' ); 
    }     

    public function setor_aviso_deletar($id)
    {
        $setor                  = Setor::setor_por_id($id);
        $setores                = Setor::paginate(10);
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);       

        $dados = [
            'page'              => 'admin.admin_setores',
            'setor'             => $setor,
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este setor, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');

        return view('admin.admin_template2', $dados);
    }

    public function setor_deletar($id)
    {
        $setor                  = Setor::findOrFail($id);   
        $setor                  ->delete();
        
       return Redirect::to('setores')->with('success', 'Setor excluído com Sucesso');
    }
}
