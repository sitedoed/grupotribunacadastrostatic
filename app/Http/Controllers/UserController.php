<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Empresa;
use App\Evento;
use App\Evento_has_cliente;
use App\Cliente;
use App\Extra_campo;
use App\Extra_conteudo;
use App\User;
use App\Feedback;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Redirect;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
        $user_id                            = Auth::user()->id;
        $aviso_feedback                     = Feedback::aviso_feedback($user_id);
        $empresas                           = Empresa::empresas();
        
                                
        $tabela_inicial = array();
        foreach($empresas as $row){
            $tabela_inicial[] = array(
                'empresa'                   => $row->empresa,
                'departamento'              => $row->departamento,
                'quantidade_de_eventos'     => Evento::quantidade_de_eventos($row->departamentos_id),
                'numero_de_inscritos'       => Evento_has_cliente::inscritos_por_departamento($eventos_id = $row->departamentos_id),
            );
        }
                    
        $dados=[
            'page'                          => 'usuarios.usuarios_home',
            'empresas'                      => $empresas,
            'aviso_feedback'                =>$aviso_feedback,
            'tabela_inicial'                =>$tabela_inicial,
        ];

        return view ('usuarios.usuarios_template2', $dados); 
    }

    public function config()
    {
        $dados=[
            'page'                          => 'usuarios.usuario_config',
        ];

        return view ('usuarios.usuarios_template2', $dados); 
    }

    public function config_edit($id, Request $request)
    {
        $user                               = User::findOrFail($id);
        $dados=[
            'page'                          => 'usuarios.usuario_config',
            'user'                          =>  $user,
        ];

        return view ('usuarios.usuarios_template2', $dados);      
    }

    public function config_atualizar($id, Request $request)
    {
       \Session::flash('retorno', 'Dados atualizados com sucesso!!!');

        $user                               = User::findOrFail($id);
        $user                               ->update($request->all());
        
        $dados=[
            'page'                          => 'admin.painel_config',
            'user'                          =>  $user,
        ];

        return Redirect::to('painel_de_controle/usuarios/config');  
    }

    public function senha_alterar($id)
    {
        $user = User::findOrFail($id);
        $dados=[
            'page'                          => 'usuarios.usuario_senha_alterar',
            'user'                          =>  $user,
        ];

        return view ('usuarios.usuarios_template2', $dados); 
    }

    public function senha_atualizar($id, Request $request)
    {
      $senha_antiga                         = $request['password'];
      $senha_nova                           = $request['password_new'];

        if($senha_antiga == $senha_nova)
        {
            $user                           = User::findOrFail($id);
            $user                           ->password = bcrypt($senha_nova);
            $user                           ->save();   

            \Session::flash('retorno', 'Senha Atualizada com Sucesso!!!');

        }else{

            \Session::flash('retorno', 'As senhas são diferentes. Por favor, tente outra vez');

        }

       return Redirect::to ('painel_de_controle/usuarios/'.$id.'/senha_alterar');
    }

    public function eventos($id=null)
    {   
        $users                              = DB::table('users')->get();
        $empresas                           = Empresa::all();
        $departamentos                      = Departamento::all();
        $eventos                            = Evento::eventos_todos();

        if(isset($id))
        {
         $evento                            = Evento::findOrFail($id);
            $dados=[
                'page'                      => 'usuarios.usuarios_eventos',
                'users'                     => $users,
                'empresas'                  => $empresas,
                'departamentos'             => $departamentos,
                'eventos'                   => $eventos,
                'confirmar'                 => Evento::evento_por_id,                                         
            ];
        }else {
            $dados=[
                'page'                      => 'usuarios.usuarios_eventos',
                'users'                     => $users,
                'empresas'                  => $empresas,
                'departamentos'             => $departamentos,
                'eventos'                   => $eventos,
            ];
        }

        return view ('usuarios.usuarios_template2', $dados); 
    }

    public function eventos_criar(Request $request)
    {
        $evento                             = new Evento();
        $data                               = $request['data'];
        $id                                 = $request['departamentos_id'];

        $empresa_id = DB::table('departamentos')
                        ->where('id', $request['departamentos_id'])
                        ->get();

        foreach($empresa_id as $row)
        {
            $empresa_id = $row->empresas_id;
            $departamento_id = $row->id;
        }

        $dados = [
            'nome'                          =>$request['nome'],
            'descricao'                     =>$request['descricao'],
            'data'                          =>$data,
            'departamentos_id'              =>$departamento_id,
            'departamentos_empresas_id'     =>$empresa_id,
        ];

        $evento = $evento->create($dados);

        \Session::flash('retorno', 'Evento Cadastrado com Sucesso!!!');

        return Redirect::to('painel_de_controle/usuarios/eventos');
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
            'page' => 'usuarios.usuarios_eventos',
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
        ];
        }else{
            $dados=[
            'page' => 'usuarios.usuarios_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'confirmar' => DB::table('eventos')
                    //->where('id', $id)
                    ->get(), 
            ];
        }
        return view ('usuarios.usuarios_template2', $dados); 
    }       

    public function eventos_atualizar($id, Request $request)
    {
        $evento = Evento::findOrFail($id);
        $data = $request['data'];
        //echo date('d-m-Y', strtotime($data));

        $empresa_id = DB::table('departamentos')
                        ->where('id', $request['departamento_id'])
                        ->get();

        foreach($empresa_id as $row)
        {
            $empresa_id = $row->empresas_id;
            $departamento_id = $row->id;
        }

        $dados = [
            'nome'                           =>$request['nome'],
            'descricao'                      =>$request['descricao'],
            'data'                           =>$data,
            'departamentos_id'               =>$departamento_id,
            'departamentos_empresas_id'      =>$empresa_id,
        ];

        $evento->update($dados);

        \Session::flash('retorno', 'Evento Atualizado com sucesso!!!');

        return Redirect::to('painel_de_controle/usuarios/'.$id.'/eventos');

    }

    public function eventos_confirmar_deletar($id)
    {
         \Session::flash('retorno', 'Atenção você está prestes a EXCLUIR esse evento, esta ação não pode ser desfeita!!! Clique em: SIM, para confirmar ou em: Não, para cancelar!!!');

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
            'page' => 'usuarios.usuarios_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'evento' => $evento,
            'confirmar' => DB::table('eventos')
                    ->where('id', $id)
                    ->get(), 
        ];
        }
        return view('usuarios.usuarios_template2', $dados);
    }
    public function painel_eventos_deletar($id)
    {
        $evento = Evento::findOrFail($id);   
        \Session::flash('Evento excluído com Sucesso');
        $evento->delete();
        return Redirect::to('painel_de_controle/usuarios/eventos');
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
        $dados=[
            'page'              =>'usuarios.usuarios_evento_estatisticas',
            'eventos'           =>$eventos,
            'evento'            =>$evento,
            'campos'            =>$campos,
            'campos_adicionais' => $campos_adicionais,
            'inscritos'         => $inscritos,
        ];
        return view ('usuarios.usuarios_template2', $dados);
    }

    public function evento_clientes($id)
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
                        'empresas.name as empresa',
                        'departamentos.name as departamento' 
                    )
            ->paginate(10);
        $evento = DB::table('eventos')
                    ->get();

        $dados=[
            'page' => 'usuarios.usuarios_clientes',
            'clientes' =>  $clientes,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'evento' => $evento,
        ];

        return view ('usuarios.usuarios_template2', $dados); 

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
                'page' => 'usuarios.usuarios_clientes',
                'clientes' =>  $clientes,
                'cliente'   => $cliente,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
            ];
         }  else{

            $dados=[
                'page' => 'usuarios.usuarios_clientes',
                'clientes' =>  $clientes,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
        ];
    }
        return view ('usuarios.usuarios_template2', $dados); 
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

     return Redirect::to('painel_de_controle/usuarios/clientes');
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

            $dados=[
                'page'              => 'usuarios.usuarios_clientes',
                'clientes'          =>  $clientes,
                'cliente'           => $cliente,
                'empresas'          => $empresas,
                'departamentos'     => $departamentos,
                'eventos'           => $eventos,
                'campos_adicionais' => $campos_adicionais,
                'extra_campos'      => $extra_campos,
                'extra_conteudos'   => $extra_conteudos,
            ];

        return view ('usuarios.usuarios_template2', $dados); 
    }
    public function cliente_salvar($id, Request $request)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        \Session::flash('retorno', 'Cliente atualizado com sucesso!!!');
         return Redirect::to('painel_de_controle/usuarios/clientes');

    }

    public function cliente_salvar_dado_especifico($id, Request $request)
    {


        $extra_conteudo = Extra_conteudo::findOrFail($id);
        $extra_conteudo->update($request->all());
        return back()->with('retorno', 'Dados atualizados com sucesso!!!');


    }

    public function cliente_confirmar_deletar($id)
    {
        \Session::flash('retorno', 'Atenção Você está prestes a EXCLUIR este cliente da nossa base de dados!!! Esta ação NÃO PODE SER DESFEITA!!!
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
           
            $dados=[
                'page' => 'usuarios.usuarios_clientes',
                'clientes' =>  $clientes,
                'cliente'   => $cliente,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
            ];

        return view ('usuarios.usuarios_template2', $dados);         
    }
    public function cliente_deletar($id)
    {
        $cliente = Cliente::findOrFail($id);   
       
        $cliente->delete();

        return Redirect::to('painel_de_controle/usuarios/cliente_deletado'); 
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
            $dados=[
                'page' => 'usuarios.usuarios_clientes',
                'clientes' =>  $clientes,
                'empresas' => $empresas,
                'departamentos' => $departamentos,
                'eventos' => $eventos,
            ];

        return view('usuarios.usuarios_template2', $dados); 

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

            $dados = [
                'page'      => 'usuarios.usuarios_resultados_pesquisa',
                'clientes'  => $clientes,
                'campo_de_pesquisa' => $campo_de_pesquisa,
            ];

        return view('usuarios.usuarios_template2', $dados);        
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
        $dados=[
            'page'    => 'usuarios.usuarios_campos_adicionais',
            'eventos' =>$eventos,
            'campos_adicionais' => $campos_adicionais,
        ];

        return view('usuarios.usuarios_template2', $dados);
    }

    public function campos_adicionais_cadastrar (Request $request)
    {

        $extra_campo = new Extra_campo();

        $extra_campo = $extra_campo->create($request->all());

        \Session::flash('retorno', 'Dados atualizados com sucesso!!!');

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


        $dados=[
            'page'              => 'usuarios.usuarios_campos_adicionais',
            'eventos'           =>$eventos,
            'campos_adicionais' => $campos_adicionais,
            'extra_campo'       =>$extra_campo,
        ];

        return view('usuarios.usuarios_template2', $dados);

    }


    public function campos_adicionais_editar($id)
    {

        //$extra_campo = new Extra_campo();

        //$extra_campo = $extra_campo->create($request->all());
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


        $dados=[
            'page'              => 'usuarios.usuarios_campos_adicionais',
            'eventos'           =>$eventos,
            'campos_adicionais' => $campos_adicionais,
            'extra_campo'       =>$extra_campo,
            'campo'             =>$campo,
        ];

        return view('usuarios.usuarios_template2', $dados);


    }

    public function campos_adicionais_atualizar($id, Request $request)
    {


    }

    public function campos_adicionais_confirmar_deletar($id)
    {
        \Session::flash('retorno', 'Atenção: Você está prestes a excluir este 
        campo adicional, esta ação não pode ser desfeita!!! Por favor, clique em: SIM, para 
        confirmar, ou acesse outro menu para mantê-lo!!!');

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


                $dados=[
                    'page'              => 'usuarios.usuarios_campos_adicionais',
                    'eventos'           =>$eventos,
                    'campos_adicionais' => $campos_adicionais,
                    'extra_campo'       =>$extra_campo,
                    'campo'             =>$campo,
                ];
                return view('usuarios.usuarios_template2', $dados);

    }

    public function campos_adicionais_deletar($id)
    {
        $extra_campo = Extra_campo::findOrFail($id);   
        $extra_campo->delete();
        \Session::flash('Campo excluído com Sucesso');
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

        $dados=[
            'page'              => 'usuarios.usuarios_campos_adicionais',
            'eventos'           =>$eventos,
            'campos_adicionais' => $campos_adicionais,
            'extra_campo'       =>$extra_campo,
            'campo'             =>$campo,
        ];

        return Redirect::to('painel_de_controle/usuarios/campos_adicionais');
    }


 public function feedback()
    {
        $id = Auth::user()->id;

            $feedback =  DB::table('feedback')
                ->join('users', 'users.id', '=', 'feedback.de_user_id')
                ->select(
                    'feedback.id as feedback_id',
                    'feedback.assunto as assunto',
                    'feedback.mensagem as mensagem',
                    'feedback.status as status',
                    'feedback.created_at as created_at',
                    'users.name as nome')
              //  ->where('feedback.de_user_id', $id)
                ->get();

        $admin = DB::table('users')
                    ->where('nivel', '1')
                    ->where('status', '1')
                    ->get();            

        $dados=[
            'page' => 'usuarios.usuarios_feedback',
            'feedback' => $feedback,
            'admin'             => User::admins(),
        ];
       return view('usuarios.usuarios_template2', $dados);
    }


    public function feedback_enviar(Request $request)
    {
      //  return $request;

       $dados = DB::table('feedback')->insert([
        'assunto'       => $request['assunto'],
        'mensagem'      => $request['mensagem'],
        'de_user_id'    => $request['de_user_id'],
        'para_user_id'  => $request['para_user_id'],
        'users_id'      => $request['de_user_id'],
       ]);

       return back()->with('success', 'Mensagem enviada com sucesso! Responderemos em breve, obrigado!');

    }

    public function feedback_resposta($id)
    { 
        $id = Auth::user()->id;    
        $responder =  DB::table('feedback')
            ->where('feedback.id', $id)
            ->join('users', 'users.id', '=', 'feedback.user_id')
            ->select(
                'feedback.id as feedback_id',
                'feedback.assunto as assunto',
                'feedback.mensagem as mensagem',
                'feedback.created_at as created_at',
                'users.name as nome')
            ->get();

        $resposta = DB::table('respostas')
            ->join('users', 'users.id', '=', 'respostas.user_id')
            ->where('feedback_id', $id)
            ->select(
                'respostas.resposta as resposta',
                'users.name as nome',
                'respostas.created_at as created_at'
            )
            ->get();

        $feedback =  DB::table('feedback')
            ->join('users', 'users.id', '=', 'feedback.user_id')
            ->select(
                'feedback.id as feedback_id',
                'feedback.assunto as assunto',
                'feedback.mensagem as mensagem',
                'feedback.status as status',
                'feedback.created_at as created_at',
                'users.name as nome')
             ->where('feedback.user_id', $id)
            ->get();

        $dados=[
            'page'         => 'usuarios.usuarios_feedback_resposta',
            'responder'    => $responder,
            'resposta'     => $resposta,
            'feedback'     => $feedback,
        ];
       return view('usuarios.usuarios_template2', $dados);
       //return back()->with('success', 'Mensagem enviada com sucesso! Responderemos em breve, obrigado!');
    }

    public function feedback_responder($id, Request $request)
    {
        $Resposta = DB::table('respostas')->insert([
                            'resposta'      =>$request['resposta'],
                            'user_id'       =>$request['user_id'],
                            'feedback_id'   =>$request['feedback_id'],
                            'users_id'      =>$request['users_id'],
                            ]);
        //Recuperando o último ID Cadastrado
/*
        $resposta_id = DB::table('respostas')->insertGetId(
                            [ 'id' => $request['id'] ]
                            );
*/
        $dados=[
            'status'    => $request['status'],
            'updated_at' => now(),
        ];
        $feedback = Feedback::findOrFail($id);
        $feedback->update($dados);

        return back()->with('success', 'Resposta enviada com sucesso!!!');
    }

 public function ramais()
    {
        $setores = DB::table('setor')
                    ->get();
        $ramais = DB::table('ramal')
                ->join('setor', 'setor.id', '=', 'ramal.setor_id')
                ->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
            'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
            ->orderBy('ramal.id', 'asc')
            ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();

        $dados = [
            'page'      => 'usuarios.usuarios_ramais',
            'setores'   => $setores,
            'ramais'    => $ramais,
            'aviso_feedback'  => $aviso_feedback,
        ];
        return view('usuarios.usuarios_template2', $dados);
    }    
    public function ramal_cadastrar(Request $request)
    {
        $ramal = new Ramal();
        $ramal_cadastrar =   DB::table('ramal')->insert([
                    'ramal'     => $request['ramal'],
                    'nome'      => $request['nome'],
                    'status'    => $request['status'],
                    'setor_id'  => $request['setor_id'], 
                    ]);
        $ramais = DB::table('ramal')
                    ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();

        $dados = [
            'page'  => 'ramais',
            'ramais'=> $ramais,
            'aviso_feedback'  => $aviso_feedback,
        ];
          return Redirect::to('painel_de_controle/admin/ramais')->with('success', 'Ramal cadastrado com Sucesso');
    }
    public function ramal_editar($id)
    {
        $ramal = DB::table('ramal')
                ->join('setor', 'setor.id', '=', 'ramal.setor_id')
                ->where('ramal.id', $id)
                    ->select(
                        'ramal.id as ramal_id',
                        'ramal.ramal as ramal',
                        'ramal.nome as nome',
                        'ramal.status as status',
                        'setor.id as setor_id',
                        'setor.setor as setor')
                    ->get();

        $ramais = DB::table('ramal')
                ->join('setor', 'setor.id', '=', 'ramal.setor_id')
                ->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
            'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
            ->orderBy('ramal.id', 'asc')
            ->paginate(10);

        $setores = DB::table('setor')
                ->orderBy('id', 'asc')
                ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();        


        $dados=[
            'page'              => 'usuarios.usuarios_ramais',
            'ramal'             => $ramal,
            'ramais'            => $ramais,
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view('usuarios.usuarios_template2', $dados);
    }
    public function ramal_atualizar($id, Request $request)
    {
        $ramal = Ramal::findOrFail($id);
        $ramal->update($request->all());
        return Redirect::to('painel_de_controle/admin/'.$id.'/ramal_editar/')->with('success', 'Ramal atualizado com sucesso!!!' );
    }

    public function ramal_aviso_deletar($id)
    {
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este ramal, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');
        //return Redirect::to('painel_de_controle/admin/'.$id.'/empresas');
        $ramal = DB::table('ramal')
                ->join('setor', 'setor.id', '=', 'ramal.setor_id')
                ->where('ramal.id', $id)
                    ->select(
                        'ramal.id as ramal_id',
                        'ramal.ramal as ramal',
                        'ramal.nome as nome',
                        'ramal.status as status',
                        'setor.id as setor_id',
                        'setor.setor as setor')
                    ->get();

        $ramais = DB::table('ramal')
                ->join('setor', 'setor.id', '=', 'ramal.setor_id')
                ->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
            'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
            ->orderBy('ramal.id', 'asc')
            ->paginate(10);

        $setores = DB::table('setor')
                ->orderBy('id', 'asc')
                ->get();
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();        


        $dados=[
            'page'              => 'usuarios.usuarios_ramais',
            'ramal'             => $ramal,
            'ramais'            => $ramais,
            'setores'           => $setores,
            'aviso_feedback'    => $aviso_feedback,
        ];
        return view('usuarios.usuarios_template2', $dados);
    }

    public function ramal_deletar($id)
    {
        $ramal = Ramal::findOrFail($id);   
        $ramal->delete();
        \Session::flash('Ramal excluído com Sucesso');
       return Redirect::to('painel_de_controle/admin/ramais')->with('danger', 'Ramal excluído com Sucesso');
    }


    public function setores()
    {
        $setores = DB::table('setor')
                    ->orderBy('id', 'asc')
                    ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();
                                
        $dados = [
            'page'      => 'usuarios.usuarios_setores',
            'setores'   => $setores,
            'aviso_feedback'  => $aviso_feedback,
        ];
        return view('usuarios.usuarios_template2', $dados);
    }
    public function setor_cadastrar(Request $request)
    {
        $setor = new Setor();
        $setor_cadastrar =   DB::table('setor')->insert([
                    'setor' => $request['setor'], 
                    ]);
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();
        $dados = [
            'page' => 'setores',
            'aviso_feedback'  => $aviso_feedback,
        ];
        return Redirect::to('setores')->with('success', 'Setor criado com sucesso!!!' ); 
    } 
        public function setor_editar($id, Request $request)
    {
        $setor = DB::table('setor')
                    ->where('id', $id)
                    ->get();
        $setores = DB::table('setor')
                    ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();            
        $dados = [
            'page'      => 'usuarios.usuarios_setores',
            'setor'     => $setor,
            'setores'   => $setores,
            'aviso_feedback'  => $aviso_feedback,
        ];
        return view('usuarios.usuarios_template2', $dados);

    } 

    public function setor_atualizar($id, Request $request)
    {
        $setor = Setor::findOrFail($id);
        $setor->update($request->all());

        return Redirect::to('painel_de_controle/admin/setores')->with('success', 'Setor atualizado com sucesso!!!' ); 
    }     

    public function setor_aviso_deletar($id)
    {
        $setor = DB::table('setor')
                    ->where('id', $id)
                    ->get();
        $setores = DB::table('setor')
                    ->paginate(10);
        $user_id = Auth::user()->id;
        $aviso_feedback =  DB::table('feedback')
                    ->where('user_id', $user_id)
                    ->count();            
        $dados = [
            'page'      => 'usuarios.usuarios_setores',
            'setor'     => $setor,
            'setores'   => $setores,
            'aviso_feedback'  => $aviso_feedback,
        ];
        \Session::flash('danger', 'Atenção: Você está prestes a excluir este setor, esta ação não pode ser desfeita!!!
            Por favor, clique em: SIM, para confirmar, ou acesse outra seção do site');

        return view('usuarios.usuarios_template2', $dados);
    }

    public function setor_deletar($id)
    {
        $setor = Setor::findOrFail($id);   
        $setor->delete();
       return Redirect::to('setores')->with('success', 'Setor excluído com Sucesso');
    }


}//Fechamento Inicial
