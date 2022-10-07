<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Cliente;
use App\Empresa;
use App\Evento;
use App\Evento_has_cliente;
use App\Extra_campo;
use App\Extra_conteudo;
use App\User;
use App\Feedback;
use App\Resposta;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Redirect;
use Auth;
use Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$clientes                           = Cliente::all()->count();
        //$eventos                            = Evento::all()->count();
        //$total_de_clientes_cadastrados      = Evento_has_cliente::count();
        //$empresas                           = Empresa::empresas();
        //$user_id                            = Auth::user()->id;
        //$aviso_feedback                     = Feedback::aviso_feedback($user_id);

        $tabela_inicial = array();
        /*
                foreach($empresas as $row)
        {
            $tabela_inicial[] = array(
                'empresa'                   =>$row->empresa,
                'departamento'              =>$row->departamento,
                'quantidade_de_eventos'     => Evento::quantidade_de_eventos($row->departamentos_id),
                'numero_de_inscritos'       =>Evento_has_cliente::inscritos_por_departamento($eventos_id = $row->departamentos_id),
            );
        }
        */

        $dados=[
            'page'                          => 'admin.admin_home',
            //'empresas'                      => $empresas,
            //'clientes'                      => $clientes,
            //'eventos'                       => $eventos,
            //'total_de_clientes_cadastrados' => $total_de_clientes_cadastrados,
            'aviso_feedback'                => 1,
            'tabela_inicial'                => $tabela_inicial,
        ];
	    return view ('admin.admin_template2', $dados);
    }

   public function usuarios()
    {
        $users                  = User::all();
        $empresas               = Empresa::all();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_usuarios',
            'users'             =>  $users,
            'empresas'          => $empresas,
            'aviso_feedback'    =>$aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }

    public function usuario_criar(Request $request)
    {
        if($request['status']==1){
            $email_verified_at = now();
        }else{
            $email_verified_at = null;
        }

        $dados=[
            'name'              => $request['name'],
            'email'             => $request['email'],
            'password'          => bcrypt($request['password']),
            'nivel'             => $request['nivel'],
            'status'            => $request['status'],
            'email_verified_at' => $email_verified_at,
        ];

        $user = new User();
        $user = $user->create($dados);
        return Redirect::to('painel_de_controle/admin/usuarios')->with('success', 'Usuário criado com sucesso!!!' );
    }

    public function usuario_editar($id, Request $request)
    {
        $user                   = User::findOrFail($id);
        $user                   ->update($request->all());
        $users                  = User::all();
        $user_id                = Auth::user()->id;
        $usuario                = User::where('id', '=', $id)->get();
        $aviso_feedback         =  Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              =>  'admin.admin_usuarios',
            'users'             =>  $users,
            'user'              =>  $user,
            'usuario'           =>  $usuario,
            'aviso_feedback'    =>$aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }
    public function usuario_atualizar($id, Request $request)
    {
        $user = User::findOrFail($id);

        if($request['status']==1){
            $email_verified_at = now();
        }else{
            $email_verified_at = null;
        }

        $dados=[
            'name'              => $request['name'],
            'email'             => $request['email'],
            'nivel'             => $request['nivel'],
            'status'            => $request['status'],
            'email_verified_at' => $email_verified_at,
        ];

        $user->update($dados);
        return Redirect::to('painel_de_controle/admin/usuarios')->with('success', 'Dados atualizados com sucesso!!!' );
    }

    public function usuario_confirmar_deletar($id)
    {
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este usuario, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');

        $users                  = DB::table('users')->get();
        $empresas               = DB::table('empresas')->get();
        $usuario                = DB::table('users')
                                    ->Where('id',$id)
                                    ->get();

        $user_id                = Auth::user()->id;
        $aviso_feedback         =  DB::table('feedback')
                                    ->where('user_id', $user_id)
                                    ->count();

        $dados=[
            'page'              => 'admin.admin_usuarios',
            'users'             =>  $users,
            'empresas'          => $empresas,
            'usuario'           => $usuario,
            'aviso_feedback'    =>$aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);


    }
    public function usuario_deletar($id)
    {
        $usuario                = User::findOrFail($id);
        $usuario                ->delete();
        \Session::flash('retorno', 'Usuario excluído com Sucesso');

       return Redirect::to('painel_de_controle/admin/usuarios');
    }

    public function config()
    {
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_config',
            'aviso_feedback'    =>$aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }

    public function config_edit($id, Request $request)
    {
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);
        $user                   = User::findOrFail($id);

        $dados=[
            'page'              => 'admin.admin_config',
            'user'              =>  $user,
            'aviso_feedback'    =>$aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
        //return Redirect::to('admin_template', $dados);
    }
    public function config_atualizar($id, Request $request)
    {
       \Session::flash('retorno', 'Dados atualizados com sucesso!!!');
        $user                   = User::findOrFail($id);
        $user                   ->update($request->all());

        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.painel_config',
            'user'              =>  $user,
            'aviso_feedback'    =>$aviso_feedback,
        ];
        return Redirect::to('painel_de_controle/admin/config');
    }
    public function senha_alterar($id)
    {
        $user                   = User::findOrFail($id);
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_senha_alterar',
            'user'              =>  $user,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }
    public function senha_atualizar($id, Request $request)
    {
      $senha_antiga             = $request['password'];
      $senha_nova               = $request['password_new'];

        if($senha_antiga == $senha_nova)
        {
            $user = User::findOrFail($id);
            $user->password = bcrypt($senha_nova);
            $user->save();
            \Session::flash('retorno', 'Senha Atualizada com Sucesso!!!');
        }else{
            \Session::flash('retorno', 'As senhas são diferentes. Por favor, tente outra vez');
        }
       return Redirect::to ('painel_de_controle/admin/'.$id.'/senha_alterar');
    }
    public function edit_user($id)
    {
        return ("É issoa ai ".$id);
    }
    public function empresas($id=null)
    {
        $users                  = DB::table('users')->get();
        $empresas               = DB::table('empresas')->get();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);
        if(isset($id))
        {
        $empresa                = Empresa::findOrFail($id);
        $empresa                = DB::table('empresas')
                                    ->where('id', $id)
                                    ->get();
            $dados=[
                'page'          => 'admin.admin_empresas',
                'users'         =>  $users,
                'empresas'      => $empresas,
                'empresa'       =>$empresa,
                'aviso_feedback'=> $aviso_feedback,
            ];
        }else{
              $dados=[
                'page'          => 'admin.admin_empresas',
                'users'         =>  $users,
                'empresas'      => $empresas,
                'aviso_feedback'=> $aviso_feedback,
        ];
        }
       return view ('admin.admin_template2', $dados);
    }
     public function empresa_criar(Request $request)
    {
        $empresa = new Empresa();

        $empresa = $empresa->create($request->all());

        \Session::flash('retorno', 'Empresa Cadastrada com Sucesso!!!');
        return Redirect::to('painel_de_controle/admin/empresas');
    }
    public function empresa_editar($id, Request $request)
    {
        $empresa                = Empresa::findOrFail($id);
        $empresa                ->update($request->all());
        $empresa                = Empresa::empresa($id);

        $empresas               = DB::table('empresas')->get();
        $user_id                = Auth::user()->id;
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_empresa_editar',
            'empresa'           => $empresa,
            'empresas'          => $empresas,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);

    }
    public function empresa_salvar($id, Request $request)
    {
        Session::flash('success', 'Empresa Atualizada com Sucesso!!!');

        $empresa                = Empresa::findOrFail($id);
        $empresa                ->update($request->all());
        $empresa                = DB::table('empresas')
                                        ->where('id', $id)
                                        ->get();

        $empresas               = DB::table('empresas')->get();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_empresa_editar',
            'empresa'           => $empresa,
            'empresas'          => $empresas,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return Redirect::To('painel_de_controle/admin/'.$id.'/empresa_editar');
    }

    public function empresa_confirmar_deletar($id)
    {
        Session::flash('error', 'Atenção: Você está prestes a excluir esta empresa, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');

        $empresa                = Empresa::empresa($id);
        $empresas               = DB::table('empresas')->get();
        $user_id                = Auth::user()->id;
        $aviso_feedback         = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_empresa_confirm_deletar',
            'empresas'          => $empresas,
            'empresa'           => $empresa,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }

    public function empresa_deletar($id)
    {
        $empresa                = Empresa::findOrFail($id);
        $empresa                ->delete();
        \Session::flash('Empresa excluída com Sucesso');

       return Redirect::to('painel_de_controle/admin/empresas')->with('error', 'Empresa excluída com Sucesso');
    }
    public function empresa_estatisticas($id)
    {
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $empresa                        = Empresa::empresa($id);
        $inscritos_por_empresa          = Evento_has_cliente::inscritos_por_empresa($id);
        $departamentos_por_empresa      = Departamento::departamentos_por_empresa($id);
        $eventos_por_empresa            = Evento::eventos_por_empresa($id);

        $dados = [
            'aviso_feedback'            => $aviso_feedback,
            'page'                      => 'admin.admin_empresa_estatisticas',
            'empresa'                   => $empresa,
            'departamentos_por_empresa' => $departamentos_por_empresa,
            'eventos_por_empresa'       => $eventos_por_empresa,
            'inscritos_por_empresa'     => $inscritos_por_empresa,
        ];

        return view ('admin.admin_template2', $dados);
    }
    public function departamentos()
    {
        $users                          = DB::table('users')->get();
        $empresas                       = DB::table('empresas')->get();
        $departamentos                  = DB::table('departamentos')
                                                ->join('empresas', 'empresas_id', '=', 'empresas.id')
                                                ->select(   'departamentos.id as id',
                                                            'departamentos.name as name',
                                                            'empresas_id as empresas_id',
                                                            'empresas.name as empresa'
                                                        )
                                                ->orderBy('empresas.name')
                                                        ->get();

        $user_id                        = Auth::user()->id;
        $aviso_feedback                 = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'                      => 'admin.admin_departamentos',
            'users'                     =>  $users,
            'empresas'                  => $empresas,
            'departamentos'             => $departamentos,
            'aviso_feedback'            => $aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }

     public function departamentos_criar(Request $request)
    {
        $departamento                   = new Departamento();

        $departamento                   = $departamento->create($request->all());

        \Session::flash('retorno', 'Departamento Cadastrado com Sucesso!!!');

        return Redirect::to('painel_de_controle/admin/departamentos');
    }

    public function departamentos_editar($id=null)
    {
       $departamento = Departamento::findOrFail($id);

        if(isset($id))
        {
            $users = DB::table('users')->get();
            $empresas = DB::table('empresas')->get();
            $departamentos = DB::table('departamentos')
            ->join('empresas', 'empresas_id', '=', 'empresas.id')
            ->select(   'departamentos.id as id',
                        'departamentos.name as name',
                        'empresas_id as empresas_id',
                        'empresas.name as empresa'
                    )
                    ->get();
            $departamento = DB::table('departamentos')
                    ->join('empresas', 'empresas_id', '=', 'empresas.id')
                    ->select(   'departamentos.id as id',
                        'departamentos.name as name',
                        'empresas_id as empresas_id',
                        'empresas.name as empresa'
                    )
                    ->where('departamentos.id', $id)
                    ->get();
            $user_id = Auth::user()->id;
            $aviso_feedback = Feedback::aviso_feedback($user_id);

            $dados=[
                'page'          => 'admin.admin_departamentos',
                'users'         => $users,
                'empresas'      => $empresas,
                'departamentos' => $departamentos,
                'departamento'  => $departamento,
                'aviso_feedback'=> $aviso_feedback,
            ];

            return view ('admin.admin_template2', $dados);
        }
    }
    public function departamentos_atualizar($id, Request $request){
        $departamento = Departamento::findOrFail($id);
        $departamento->update($request->all());

        \Session::flash('retorno', 'Departamento Atualizado com Sucesso!!!');

        return Redirect::to('painel_de_controle/admin/departamentos');
    }
    public function departamentos_confirmar_deletar($id)
    {
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este departamento, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção, do painel, para mantê-lo!!!');
        $departamento = DB::table('departamentos')
                    ->join('empresas', 'empresas_id', '=', 'empresas.id')
                    ->select(
                        'departamentos.id as id',
                                    'departamentos.name as name',
                                    'empresas.name as empresa'
                            )
                    ->where('departamentos.id', $id)
                    ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

       //return Redirect::to($id.'/departamentos');
        $users = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')
                        ->join('empresas', 'empresas_id', '=', 'empresas.id')
                        ->select(   'departamentos.id as id',
                                    'departamentos.name as name',
                                    'empresas_id as empresas_id',
                                    'empresas.name as empresa'
                                )
                                ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page' => 'admin.admin_departamentos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'departamento' => $departamento,
            'aviso_feedback' =>$aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);

    }
    public function departamentos_deletar($id)
    {
        $departamento = Departamento::findOrFail($id);
        \Session::flash('retorno', 'Departamento excluído com sucesso!!!');
         $departamento->delete();
        return Redirect::to('painel_de_controle/admin/departamentos');
    }
    public function departamento_estatisticas($departamento_id)
    {
        $departamento                   = Departamento::find($departamento_id);
        $eventos_por_departamento       = Evento::eventos_por_departamento($departamento_id);
        $inscritos_por_departamento     = Evento_has_cliente::inscritos_por_departamento($departamento_id);
        $departamento_da_empresa        = Departamento::departamento_da_empresa($departamento_id);
        $aviso_feedback                 = Feedback::aviso_feedback(Auth::user()->id);

        $dados=[
            'page'                      => 'admin.admin_departamento_estatisticas',
            'departamento'              => $departamento,
            'eventos_por_departamento'  => $eventos_por_departamento,
            'inscritos_por_departamento'=> $inscritos_por_departamento,
            'departamento_da_empresa'   => $departamento_da_empresa,
            'aviso_feedback'            => "$aviso_feedback",
        ];

        return view('admin.admin_template2', $dados);
    }
    public function eventos($id=null)
    {
        $users = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as id',
                        'eventos.nome as nome',
                        'eventos.data as data',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->orderBy('id', 'asc')
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        if(isset($id))
        {
         $evento = Evento::findOrFail($id);
        $dados=[
            'page' => 'admin.admin_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'confirmar' => DB::table('eventos')
                    ->where('id', $id)
                    ->get(),
            'aviso_feedback' => $aviso_feedback,
        ];
        }else{
            $dados=[
            'page' => 'admin.admin_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'aviso_feedback'=> $aviso_feedback,
        ];
        }
        return view ('admin.admin_template2', $dados);
    }
    public function eventos_criar(Request $request)
    {
        $evento = new Evento();

        $data = $request['data'];

        $empresa_id = DB::table('departamentos')
                        ->where('id', $request['departamentos_id'])
                        ->get();

        foreach($empresa_id as $row)
        {
            $empresa_id = $row->empresas_id;
            $departamento_id = $row->id;
        }

        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados = [
            'nome'                           =>$request['nome'],
            'descricao'                      =>$request['descricao'],
            'data'                           =>$data,
            'departamentos_id'               =>$departamento_id,
            'departamentos_empresas_id'      =>$empresa_id,
            'aviso_feedback'                 =>$aviso_feedback,
        ];

        $evento = $evento->create($dados);

        \Session::flash('retorno', 'Evento Cadastrado com Sucesso!!!');

        return Redirect::to('painel_de_controle/admin/eventos');
    }

    public function eventos_editar($id, Request $request)
    {
        $users = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as id',
                        'eventos.nome as nome',
                        'eventos.descricao as descricao',
                        'eventos.data as data',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        if(isset($id))
        {
            $evento = Evento::findOrFail($id);
            $evento = DB::table('eventos')
                ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
                ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
                ->select(   'eventos.id as id',
                            'eventos.nome as nome',
                            'eventos.descricao as descricao',
                            'eventos.data as data',
                            'empresas.name as empresa',
                            'departamentos.name as departamento'
                        )
                ->where('eventos.id', $id)
                ->paginate(10);
        $dados=[
            'page' => 'admin.admin_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'evento'    =>$evento,
            'confirmar' => DB::table('eventos')
                    ->where('id', $id)
                    ->get(),
            'campos_adicionais' => DB::table('extra_campos')
                    ->where('eventos_id', $id)
                    ->get(),
            'aviso_feedback' => $aviso_feedback,
        ];
        }else{
            $dados=[
            'page' => 'admin.admin_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'confirmar' => DB::table('eventos')
                    ->get(),
            'aviso_feedback' => $aviso_feedback,
            ];
        }
        return view ('admin.admin_template2', $dados);
    }

    public function eventos_atualizar($id, Request $request)
    {
        $evento = Evento::findOrFail($id);
        $data = $request['data'];

        $empresa_id = DB::table('departamentos')
                        ->where('id', $request['departamento_id'])
                        ->get();

        foreach($empresa_id as $row)
        {
            $empresa_id = $row->empresas_id;
            $departamento_id = $row->id;
        }
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados = [
            'nome'                           =>$request['nome'],
            'descricao'                      =>$request['descricao'],
            'data'                           =>$data,
            'departamentos_id'               =>$departamento_id,
            'departamentos_empresas_id'      =>$empresa_id,
            'aviso_feedback'                 =>$aviso_feedback,
        ];

        $evento->update($dados);

        \Session::flash('retorno', 'Evento Atualizado com sucesso!!!');

        return Redirect::to('painel_de_controle/admin/'.$id.'/eventos');

    }

    public function eventos_confirmar_deletar($id)
    {
         \Session::flash('danger', 'Atenção você está prestes a EXCLUIR esse evento, esta ação não pode ser desfeita!!! Clique em: SIM, para confirmar ou em: Não, para cancelar!!!');

        $users = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as id',
                        'eventos.nome as nome',
                        'eventos.data as data',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        if(isset($id))
        {
            $evento = Evento::findOrFail($id);
            $evento = DB::table('eventos')
                ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
                ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
                ->select(   'eventos.id as id',
                            'eventos.nome as nome',
                            'eventos.descricao as descricao',
                            'eventos.data as data',
                            'empresas.name as empresa',
                            'departamentos.name as departamento'
                        )
                ->where('eventos.id', $id)
                ->get();
        $dados=[
            'page' => 'admin.admin_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'evento' => $evento,
            'confirmar' => DB::table('eventos')
                    ->where('id', $id)
                    ->get(),
            'aviso_feedback' => $aviso_feedback,
        ];
        }
        return view('admin.admin_template2', $dados);
    }
    public function painel_eventos_deletar($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();
        return Redirect::to('painel_de_controle/admin/eventos')->with('retorno', 'Evento excluído com Sucesso');
    }
    public function evento_estatisticas ($id)
    {
        $eventos = DB::table('eventos')
                    ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
                    ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
                    ->select(   'eventos.id as id',
                                'eventos.nome as nome',
                                'eventos.descricao as descricao',
                                'empresas.name as empresa',
                                'departamentos.name as departamento'
                            )
                    ->paginate(10);
        $evento = Evento::findOrFail($id);
        $evento = DB::table('eventos')
                    ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
                    ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
                    ->select(   'eventos.id as id',
                                'eventos.nome as nome',
                                'eventos.descricao as descricao',
                                'eventos.data as data',
                                'empresas.name as empresa',
                                'departamentos.name as departamento'
                            )
                    ->where('eventos.id', $id)
                    ->get();

          //Selecionando todos os campos da tabela
        $campos = DB::getSchemaBuilder()->getColumnListing('clientes');
        $campos_adicionais = DB::table('extra_campos')
                                ->where('eventos_id', $id)
                                ->get();
        $inscritos = DB::table('eventos_has_clientes')
                                ->where('eventos_id', $id)
                                ->count();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              =>'admin.admin_evento_estatisticas',
            'eventos'           =>$eventos,
            'evento'            =>$evento,
            'campos'            =>$campos,
            'campos_adicionais' => $campos_adicionais,
            'inscritos'         => $inscritos,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }

    public function eventos_por_empresa($id){
        $empresa_id = $id;
        $empresa = Empresa::findOrFail($id);

        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);


        $dados = [
            'empresa'               => $empresa,
            'page'                  => 'admin.admin_eventos_por_empresa',
            'eventos'               => Evento::eventos_por_empresa($empresa_id),
            'quantidade_de_eventos' => Evento::eventos_por_empresa($empresa_id)->count(),
            'aviso_feedback'        => $aviso_feedback,
        ];

        return view ('admin.admin_template2', $dados);
    }

    public function evento_clientes($id = '1')
    {
        $clientes = DB::table('clientes')

            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2',  'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo', 'eventos.nome as evento'
            )
            ->where('eventos.id', $id)
            ->paginate(10);

        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'eventos.data as evento_data',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $evento = DB::table('eventos')
                    ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'          => 'admin.admin_evento_selecionado',
            'clientes'      => $clientes,
            'empresas'      => $empresas,
            'departamentos' => $departamentos,
            'eventos'       => $eventos,
            'evento'        => $evento,
            'aviso_feedback'=> $aviso_feedback,
        ];

        return view ('admin.admin_template2', $dados);

    }

    public function clientes($id=null)
    {
        $clientes = DB::table('clientes')
            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2',  'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo', 'eventos.nome as evento'
            )
            ->paginate(10);

        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

         if(isset($id))
         {
            //$cliente = Cliente::findOrFail($id);
            $clientes = DB::table('clientes')
                ->join('eventos_has_clientes', 'clientes.id', '=',
                    'eventos_has_clientes.clientes_id')
                ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                    'eventos.id')
                            ->where('id', $id)
                            ->select(   'eventos.id as evento_id',
                                        'eventos.departamentos_id as eventos_departamento_id',
                                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                                        'eventos.nome as nome',
                                        'empresas.name as empresa',
                                        'departamentos.name as departamento'
                                    )
                            ->get();
            $dados=[
                'page' => 'admin.admin_clientes',
                'clientes' =>  $clientes,
                'cliente'   => $cliente,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
                'aviso_feedback' => $aviso_feedback,
            ];
         }  else{

            $dados=[
                'page' => 'admin.admin_clientes',
                'clientes' =>  $clientes,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
                'aviso_feedback' => $aviso_feedback,
        ];
    }
        return view ('admin.admin_template2', $dados);
    }


     public function clientes_cadastrar(Request $request)
    {
        $cliente = new Cliente();

        $cliente = DB::table('clientes')->insert([
                            'name'      =>$request['name'],
                            'email1'    =>$request['email1'],
                            'email2'    =>$request['email2'],
                            'tel1'      =>$request['tel1'],
                            'tel2'      =>$request['tel2'],
                            'endereco'  =>$request['endereco'],
                            'bairro'    =>$request['bairro'],
                            'cidade'    =>$request['cidade'],
                            'estado'    =>$request['estado'],
                            'cep'       =>$request['cep'],
                            'rg'        =>$request['rg'],
                            'cpf'       =>$request['cpf'],
                            'sexo'      =>$request['sexo'],
                            ]);

        //Recuperando o último ID Cadastrado
        $clientes_id = DB::table('clientes')->insertGetId(
                            [ 'name' => $request['name'] ]
                            );

        $ids = DB::table('eventos')

                            ->where('id', $request['eventos_id'])
                            ->get();

        foreach($ids as $row)
        {
            $eventos_id         = $row->id;
            $departamentos_id   = $row->departamentos_id;
            $empresas_id        = $row->departamentos_empresas_id;
        }

        $relacionamento =   DB::table('eventos_has_clientes')->insert([
                    'eventos_id' => $eventos_id,
                    'eventos_departamentos_id' => $departamentos_id,
                    'eventos_departamentos_empresas_id' => $empresas_id,
                    'clientes_id' => $clientes_id,
                    ]);

        \Session::flash('retorno', 'Cliente cadastrado com Sucesso!!!');

     return Redirect::to('painel_de_controle/admin/clientes');
    }

    public function clientes_editar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente=DB::table('clientes')
            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2', 'clientes.data_de_nascimento as data_de_nascimento', 'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo',
                'eventos.id as evento_id','eventos.nome as evento',
                'eventos_departamentos_id as departamento_id', 'eventos_departamentos_empresas_id as empresa_id' )
                        ->where('clientes.id', $id)
                        ->get();
        $clientes = DB::table('clientes')
            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2',  'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo', 'eventos.nome as evento' )
            ->paginate(10);
        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();
        $campos_adicionais = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();
        $extra_campos = DB::table('extra_campos')
            ->join('eventos_has_clientes', 'extra_campos.eventos_id', '=', 'eventos_has_clientes.eventos_id')
            ->where('eventos_has_clientes.clientes_id', $id)
            ->select( 'extra_campos.id as extra_campos_id', 'extra_campos.name as campo')
            ->get();
        $extra_conteudos = DB::table('extra_conteudos')
            ->join('extra_campos', 'extra_conteudos.extra_campos_id', '=', 'extra_campos.id')
            ->where('clientes_id', $id)
            ->select( 'extra_conteudos.id as extra_conteudos_id', 'extra_campos.id as extra_campos_id', 'extra_campos.name as campo', 'extra_conteudos.conteudo as conteudo')
            ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);
            $dados=[
                'page'              => 'admin.admin_clientes',
                'clientes'          =>  $clientes,
                'cliente'           => $cliente,
                'empresas'          => $empresas,
                'departamentos'     => $departamentos,
                'eventos'           => $eventos,
                'campos_adicionais' => $campos_adicionais,
                'extra_campos'      => $extra_campos,
                'extra_conteudos'   => $extra_conteudos,
                'aviso_feedback'    => $aviso_feedback,
            ];

        return view ('admin.admin_template2', $dados);
    }
    public function cliente_salvar($id, Request $request)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        \Session::flash('retorno', 'Cliente atualizado com sucesso!!!');
         return Redirect::to('painel_de_controle/admin/clientes');

    }


    public function cliente_salvar_dado_especifico($id, Request $request)
    {
        $extra_conteudo = Extra_conteudo::findOrFail($id);
        $extra_conteudo->update($request->all());
        return back()->with('retorno', 'Dados atualizados com sucesso!!!');
    }



    public function cliente_salvar_dados_especificos($id, Request $request)
    {
        $arr = $request->all();
        foreach($arr as $key => $value){
            $arr[$key] = 'novo valor';
        }
        print_r($arr);

        $novo = $request->all();
        echo "<pre>";
        print_r($novo);

        echo "</pre>";
    }

    public function cliente_confirmar_deletar($id)
    {
        \Session::flash('danger', 'Atenção Você está prestes a EXCLUIR este cliente da nossa base de dados!!! Esta ação NÃO PODE SER DESFEITA!!!
            Clique em CONFIRMAR, para deletá-lo ou acesse outra função para mantê-lo!!!');


        $cliente = Cliente::findOrFail($id);
        $cliente=DB::table('clientes')
                        ->where('id', $id)
                        ->get();
        $clientes = DB::table('clientes')
            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2',  'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo', 'eventos.nome as evento'
            )
            ->paginate(10);
        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

            $dados=[
                'page' => 'admin.admin_clientes',
                'clientes' =>  $clientes,
                'cliente'   => $cliente,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
                'aviso_feedback' => $aviso_feedback,
            ];

        return view ('admin.admin_template2', $dados);
    }
    public function cliente_deletar($id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return Redirect::to('painel_de_controle/admin/cliente_deletado');
    }

    public function cliente_deletado()
    {
         \Session::flash('retorno', 'Cliente excluído com Sucesso');
        $clientes = DB::table('clientes')
            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2',  'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo', 'eventos.nome as evento'
            )
            ->paginate(10);

        $empresas = DB::table('empresas')->get();
        $departamentos = DB::table('departamentos')->get();
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

            $dados=[
                'page' => 'admin.admin_clientes',
                'clientes' =>  $clientes,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
                'aviso_feedback' => $aviso_feedback,
            ];

        return view('admin.admin_template2', $dados);

    }

    public function pesquisar (Request $request)
    {
        $campo_de_pesquisa = $request->campo_de_pesquisa;

        $clientes = DB::table('clientes')
            ->join('eventos_has_clientes', 'clientes.id', '=',
                'eventos_has_clientes.clientes_id')
            ->join('eventos', 'eventos_has_clientes.eventos_id', '=',
                'eventos.id')
            ->select(   'clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'clientes.email2 as email2', 'clientes.tel1 as tel1', 'clientes.tel2 as tel2',  'clientes.endereco as endereco', 'clientes.bairro as bairro', 'clientes.cidade as cidade', 'clientes.estado as estado', 'clientes.cep as cep', 'clientes.rg as rg', 'clientes.cpf as cpf', 'clientes.sexo as sexo', 'eventos.nome as evento'
            )
            ->where('name', 'like', '%'.$campo_de_pesquisa.'%')
            ->orderBy('cliente_id', 'asc')
            ->paginate(10);
            $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

            $dados = [
                'page'              => 'admin.admin_resultados_pesquisa',
                'clientes'          => $clientes,
                'campo_de_pesquisa' => $campo_de_pesquisa,
                'aviso_feedback'    => $aviso_feedback,
            ];

        return view('admin.admin_template2', $dados);
    }
    public function campos_adicionais ()
    {
        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $campos_adicionais = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'    => 'admin.admin_campos_adicionais',
            'eventos' =>$eventos,
            'campos_adicionais' => $campos_adicionais,
            'aviso_feedback'    => $aviso_feedback,
        ];

        return view('admin.admin_template2', $dados);
    }

    public function campos_adicionais_cadastrar (Request $request)
    {

        $extra_campo = new Extra_campo();

        $extra_campo = $extra_campo->create($request->all());

        \Session::flash('retorno', 'Campo cadastrado com sucesso!!!');

        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);

        $campos_adicionais = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_campos_adicionais',
            'eventos'           => $eventos,
            'campos_adicionais' => $campos_adicionais,
            'extra_campo'       => $extra_campo,
            'aviso_feedback'    => $aviso_feedback
        ];

        return view('admin.admin_template2', $dados);

    }


    public function campos_adicionais_editar($id)
    {
        $extra_campo = DB::table('extra_campos')
                            -> where('id', $id)
                            -> get();


        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);

        $campo = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->where('extra_campos.id', $id)
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();

        $campos_adicionais = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'              => 'admin.admin_campos_adicionais',
            'eventos'           => $eventos,
            'campos_adicionais' => $campos_adicionais,
            'extra_campo'       => $extra_campo,
            'campo'             => $campo,
            'aviso_feedback'    => $aviso_feedback,
        ];

       return view('admin.admin_template2', $dados);

        //return bac;k();


    }

    public function campos_adicionais_atualizar($id, Request $request)
    {

        $extra_campo = Extra_campo::findOrFail($id);
        $extra_campo->update($request->all());
        return Redirect::to('painel_de_controle/admin/campos_adicionais')->with('retorno', 'Dados atualizados com sucesso!!!' );

    }

    public function campos_adicionais_confirmar_deletar($id)
    {
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este
        campo adicional, esta ação não pode ser desfeita!!! Por favor, clique em: SIM, para
        confirmar, ou acesse outro ítem do menu para mantê-lo!!!');

        $extra_campo = DB::table('extra_campos')
                                    -> where('id', $id)
                                    -> get();

               // \Session::flash('retorno', 'Dados atualizados com sucesso!!!');

                $eventos = DB::table('eventos')
                    ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
                    ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
                    ->select(   'eventos.id as evento_id',
                                'eventos.departamentos_id as eventos_departamento_id',
                                'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                                'eventos.nome as nome',
                                'empresas.name as empresa',
                                'departamentos.name as departamento'
                            )
                    ->paginate(10);

                $campo = DB::table('extra_campos')
                    ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
                    ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
                    ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
                    ->where('extra_campos.id', $id)
                    ->select(   'extra_campos.id as extra_id',
                                'extra_campos.name as campo',
                                'eventos.id as evento_id',
                                'eventos.departamentos_id as eventos_departamento_id',
                                'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                                'eventos.nome as nome',
                                'empresas.name as empresa',
                                'departamentos.name as departamento'
                            )
                    ->get();


                $campos_adicionais = DB::table('extra_campos')
                    ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
                    ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
                    ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
                    ->select(   'extra_campos.id as extra_id',
                                'extra_campos.name as campo',
                                'eventos.id as evento_id',
                                'eventos.departamentos_id as eventos_departamento_id',
                                'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                                'eventos.nome as nome',
                                'empresas.name as empresa',
                                'departamentos.name as departamento'
                            )
                    ->paginate(10);

                $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

                $dados=[
                    'page'              => 'admin.admin_campos_adicionais',
                    'eventos'           => $eventos,
                    'campos_adicionais' => $campos_adicionais,
                    'extra_campo'       => $extra_campo,
                    'campo'             => $campo,
                    'aviso_feedback'    => $aviso_feedback,
                ];

                return view('admin.admin_template2', $dados);

    }

    public function campos_adicionais_deletar($id)
    {
        $extra_campo = Extra_campo::findOrFail($id);
        $extra_campo->delete();
        $extra_campo = DB::table('extra_campos')
                                    -> where('id', $id)
                                    -> get();

        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
            ->select(   'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);

        $campo = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->where('extra_campos.id', $id)
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->get();

        $campos_adicionais = DB::table('extra_campos')
            ->join('departamentos', 'extra_campos.eventos_departamentos_id', '=', 'departamentos.id')
            ->join('empresas', 'extra_campos.eventos_departamentos_empresas_id', '=', 'empresas.id')
            ->join('eventos', 'extra_campos.eventos_id', '=', 'eventos.id')
            ->select(   'extra_campos.id as extra_id',
                        'extra_campos.name as campo',
                        'eventos.id as evento_id',
                        'eventos.departamentos_id as eventos_departamento_id',
                        'eventos.departamentos_empresas_id as eventos_departamentos_empresas_id',
                        'eventos.nome as nome',
                        'empresas.name as empresa',
                        'departamentos.name as departamento'
                    )
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'                  => 'admin.admin_campos_adicionais',
            'eventos'               => $eventos,
            'campos_adicionais'     => $campos_adicionais,
            'extra_campo'           => $extra_campo,
            'campo'                 => $campo,
            'aviso_feedback'        => $aviso_feedback,
        ];

        return Redirect::to('painel_de_controle/admin/campos_adicionais')->with('retorno', 'Campo excluído com sucesso!!!');
    }


    public function feedback()
    {
        $user_id                    = Auth::user()->id;
        $feedbacks_enviados         = Feedback::feedbacks_enviados($user_id);
        $feedbacks_recebidos        = Feedback::feedbacks_recebidos($user_id);
        $feedbacks_todos            = Feedback::feedbacks_todos($user_id);
        $aviso_feedback             = Feedback::aviso_feedback($user_id);



        $tabela_feedback = array();
        foreach($feedbacks_todos as $row)
        {
            $tabela_feedback[] = array(
                'feedback_id'               => $row->feedback_id,
                'assunto'                   => $row->assunto,
                'mensagem'                  => $row->mensagem,
                'de'                        => $row->nome,
                'para'                      => Feedback::nome_para($row->feedback_id),
                'created_at'                => $row->created_at,
                'status'                    => $row->status,
            );
        }


        $dados=[
            'page'                  => 'admin.admin_feedback',
            'tabela_feedback'       => $tabela_feedback,
            'feedbacks_enviados'    => $feedbacks_enviados,
            'feedbacks_recebidos'   => $feedbacks_recebidos,
            'feedbacks_todos'       => $feedbacks_todos,
            'aviso_feedback'        => $aviso_feedback,
            'admin'                 => User::admins(),
        ];
        return view('admin.admin_template2', $dados);
    }

    public function feedback_enviar(Request $request)
    {
       $dados = DB::table('feedback')->insert([
            'assunto'               => $request['assunto'],
            'mensagem'              => $request['mensagem'],
            'de_user_id'            => $request['de_user_id'],
            'para_user_id'          => $request['para_user_id'],
            'users_id'              => $request['de_user_id'],
       ]);

        return back()->with('success', 'Mensagem enviada com sucesso! Responderemos em breve, obrigado!');

    }

    public function feedback_confirmar_deletar($id)
    {
        $user_id                    = Auth::user()->id;
        $aviso_feedback             = Feedback::aviso_feedback($user_id);
        $responder                  = Feedback::feedbacks_recebidos($user_id);
        $feedbacks_enviados         = Feedback::feedbacks_enviados($user_id);
        $feedbacks_recebidos        = Feedback::feedbacks_recebidos($user_id);
        $feedbacks_todos            = Feedback::feedbacks_todos($user_id);
        $resposta                   = Resposta::Respostas_feedback($id);
        $feedback                   = Feedback::feedback($id);

        Session::flash('error', 'Atenção: Você está prestes a excluir este feedback, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site. obrigado.');

        $dados=[
            'page'                  => 'admin.admin_feedback',
            'responder'             => $responder,
            'resposta'              => $resposta,
            'feedback'              => $feedback,
            'feedbacks_todos'       => $feedbacks_todos,
            'aviso_feedback'        => $aviso_feedback,
            'feedbacks_enviados'    => $feedbacks_enviados,
            'feedbacks_recebidos'   => $feedbacks_recebidos,
            'admin'                 => User::admins(),
        ];

        return view('admin.admin_template2', $dados);
    }

    public function feedback_deletar($id)
    {
        Session::flash('success', 'Feedback excluído com sucesso!!!');

        $feedback                   = Feedback::findOrFail($id);
        $feedback->delete();

        return Redirect::to('painel_de_controle/admin/feedback');
    }


    public function feedback_responder($id, Request $request)
    {
        $user_id                    = Auth::user()->id;
        $aviso_feedback             = Feedback::aviso_feedback($user_id);

        $resposta   = Resposta::create([
                    'resposta'      =>$request['resposta'],
                    'de_user_id'    =>$request['de_user_id'],
                    'para_user_id'  =>$request['para_user_id'],
                    'feedback_id'   =>$request['feedback_id'],
                    'users_id'      =>$request['users_id'],
                    ]);

        $dados      =[
                        'status'    => '0',
                        'updated_at'=> now(),
                    ];

        $feedback                   = Feedback::findOrFail($id);
        $feedback->status           = $request->status;
        $feedback->updated_at       = now();
        $feedback->save();

        return back()->with('success', 'Resposta enviada com sucesso!!!');
    }

    public function feedback_resposta($id)
    {
        $user_id                    = Auth::user()->id;
        $responder                  = Feedback::feedback_responder($id);
        $feedbacks_recebidos        = Feedback::feedbacks_recebidos($user_id);
        $resposta                   = Resposta::Respostas_feedback($id);
        $feedback                   = Feedback::feedback($id);
        $feedbacks_lista            = Feedback::all();
        $aviso_feedback             = Feedback::aviso_feedback($user_id);

        $dados=[
            'page'                  => 'admin.admin_feedback_resposta',
            'feedbacks_recebidos'   => $feedbacks_recebidos,
            'responder'             => $responder,
            'resposta'              => $resposta,
            'feedback'              => $feedback,
            'feedbacks_lista'       => $feedbacks_lista,
            'aviso_feedback'        => $aviso_feedback,
        ];
       return view('admin.admin_template2', $dados);
    }

     public function feedback_resposta_editar($id, Request $request)
    {
        //resgatar feedback_id pelo form
        //$id = 17;
        $feedback_id                = $request['feedback_id'];
        $resposta_id                = $request['resposta_id'];
        $user_id                    = Auth::user()->id;
        $responder                  = Feedback::feedback_responder($id);
        $feedbacks_recebidos        = Feedback::feedbacks_recebidos($user_id);
        $resposta                   = Resposta::Respostas_feedback($feedback_id);
        $resposta_editar            = Resposta::Respostas_feedback_editar($id);
        $feedback                   = Feedback::feedback($feedback_id);
        $feedbacks_lista            = Feedback::all();
        $aviso_feedback             = Feedback::aviso_feedback($user_id);
        $dados = [
            'page'                  => 'admin.admin_resposta_editar',
            'feedbacks_recebidos'   => $feedbacks_recebidos,
            'responder'             => $responder,
            'resposta'              => $resposta,
            'resposta_editar'       => $resposta_editar,
            'feedback'              => $feedback,
            'feedbacks_lista'       => $feedbacks_lista,
            'aviso_feedback'        => $aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);
    }

    public function feedback_resposta_atualizar($id, Request $request)
    {
        Session::flash('success', 'Resposta atualizada com sucesso!!!');

        $resposta                   = Resposta::find($id);
        $resposta->resposta         = $request->resposta;
        $resposta->save();

        $feedback_id                = $request['feedback_id'];
        $user_id                    = Auth::user()->id;
        $responder                  = Feedback::feedback_responder($id);
        $feedbacks_recebidos        = Feedback::feedbacks_recebidos($user_id);
        $resposta                   = Resposta::Respostas_feedback($feedback_id);
        $resposta_editar            = Resposta::Respostas_feedback_editar($id);
        $feedback                   = Feedback::feedback($id);
        $feedbacks_lista            = Feedback::all();
        $aviso_feedback             = Feedback::aviso_feedback($user_id);
        $dados = [
            'page'                  => 'admin.admin_resposta_editar',
            'feedbacks_recebidos'   => $feedbacks_recebidos,
            'responder'             => $responder,
            'resposta'              => $resposta,
            'resposta_editar'       => $resposta_editar,
            'feedback'              => $feedback,
            'feedbacks_lista'       => $feedbacks_lista,
            'aviso_feedback'        => $aviso_feedback,
        ];
        return view('admin.admin_template2', $dados);

    }

    public function feedback_resposta_confirmar_deletar($id, Request $request)
    {
        Session::flash('error', 'Atenção: Você está prestes a excluir esta resposta, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');

        $feedback_id = $request['feedback_id'];
        $user_id                    = Auth::user()->id;
        $responder                  = Feedback::feedback_responder($id);
        $feedbacks_recebidos        = Feedback::feedbacks_recebidos($user_id);
        $resposta                   = Resposta::Respostas_feedback($feedback_id);
        $resposta_editar            = Resposta::Respostas_feedback_editar($id);
        $feedback                   = Feedback::feedback($id);
        $feedbacks_lista            = Feedback::all();
        $aviso_feedback             = Feedback::aviso_feedback($user_id);
        $dados = [
            'page'                  => 'admin.admin_resposta_editar',
            'feedbacks_recebidos'   => $feedbacks_recebidos,
            'responder'             => $responder,
            'resposta'              => $resposta,
            'resposta_editar'       => $resposta_editar,
            'feedback'              => $feedback,
            'feedbacks_lista'       => $feedbacks_lista,
            'aviso_feedback'        => $aviso_feedback,
        ];
        return view ('admin.admin_template2', $dados);
    }

     public function feedback_resposta_deletar($id, Request $request)
    {
        Session::flash('success', 'Resposta excluída com sucesso!!!');

        $feedback_id                = $request['feedback_id'];
        $feedback                   = Feedback::findOrFail($feedback_id);
        $feedback->status           = NULL;
        $feedback->save();

        $resposta = Resposta::find($id);

        $resposta->delete();

        return Redirect::To('painel_de_controle/admin/feedback');
    }


    public function acesso_restrito()
    {
        Return view( 'acesso_restrito');
    }

    public function logout()
    {
      Auth::logout();
      return Redirect::to('login');
    }

    public function teste(Request $request)
    {
     $contador = 0;

        foreach ($request['conteudo'] as $key)
        {
            $contador++;
            echo $contador;

            $array[$contador] = [
            'conteudo' => $request['conteudo'][$contador-1],
            'clientes_id' => $request['clientes_id'][$contador-1],
            'extra_campos_id' => $request['extra_campos_id'][$contador-1],
            'extra_campos_eventos_id' => $request['extra_campos_eventos_id'][$contador-1],
            'extra_campos_eventos_departamentos_id' => $request['extra_campos_eventos_departamentos_id'][$contador-1],
            'extra_campos_eventos_departamentos_empresas_id' => $request['extra_campos_eventos_departamentos_empresas_id'][$contador-1],
             ];

            $extra_conteudo = new Extra_conteudo();
            $extra_conteudo = $extra_conteudo->create($array);
        }

        \Session::flash('retorno', 'Campo Cadastrado com Sucesso!!!');

        echo "<pre>";
        print_r($array);
        //print_r(array_chunk($novo, 1, true));
        echo "</pre>";

        return $request;
    }







}//fechamento inicial
