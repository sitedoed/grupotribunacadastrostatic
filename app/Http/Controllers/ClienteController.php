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
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Redirect;
use Carbon;

class ClienteController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $empresas = DB::table('empresas')
                    ->join('departamentos', 'empresas.id', '=', 'departamentos.empresas_id')
                    ->join('eventos', 'eventos.departamentos_empresas_id', '=', 'eventos.id')
                    ->select(   'empresas.id as empresas_id', 'empresas.name as empresa', 'departamentos.id as departamentos_id', 'departamentos.name as departamento','eventos.nome as evento' 
                    )
                    ->orderBy('empresa')
                    ->get();
                                
        $tabela_inicial = array();
        foreach($empresas as $row){
            $tabela_inicial[] = array(
                'empresa'              =>$row->empresa,
                'departamento'          =>$row->departamento,
                'quantidade_de_eventos' => Evento::quantidade_de_eventos($row->departamentos_id),
                'numero_de_inscritos'   =>Evento_has_cliente::inscritos_por_departamento($eventos_id = $row->departamentos_id),
            );
        }
                    
        $dados=[
            'page'          => 'usuarios.usuarios_home',
            'empresas'      => $empresas,
            'tabela_inicial'                =>$tabela_inicial,
        ];
        return view ('clientes.clientes_template2', $dados);  
    }

    public function config()
    {
        $dados=[
            'page' => 'clientes.cliente_config',
        ];
        return view ('clientes.clientes_template2', $dados); 
    }
    public function config_edit($id, Request $request)
    {
        $user = User::findOrFail($id);
        $dados=[
            'page' => 'clientes.cliente_config',
            'user' =>  $user,
        ];
        return view ('clientes.clientes_template2', $dados);      
    }
    public function config_atualizar($id, Request $request)
    {
       \Session::flash('retorno', 'Dados atualizados com sucesso!!!');
        $user = User::findOrFail($id);
        $user->update($request->all());
        $dados=[
            'page' => 'cliente.cliente_config',
            'user' =>  $user,
        ];
        return Redirect::to('painel_de_controle/clientes/config');  
    }
    public function senha_alterar($id)
    {
        $user = User::findOrFail($id);
        $dados=[
            'page' => 'clientes.cliente_senha_alterar',
            'user' =>  $user,
        ];
        return view ('clientes.clientes_template2', $dados); 
    }
    public function senha_atualizar($id, Request $request)
    {
      $senha_antiga = $request['password'];
      $senha_nova = $request['password_new'];

        if($senha_antiga == $senha_nova)
        {
            $user = User::findOrFail($id);
            $user->password = bcrypt($senha_nova);
            $user->save();   
            \Session::flash('retorno', 'Senha Atualizada com Sucesso!!!');
        }else{
            \Session::flash('retorno', 'As senhas são diferentes. Por favor, tente outra vez');
        }
       return Redirect::to ('painel_de_controle/clientes/'.$id.'/senha_alterar');
    }

    public function pesquisar (Request $request)
    {
        $campo_de_pesquisa = $request->campo_de_pesquisa;

        $eventos = DB::table('eventos')
            ->join('departamentos', 'eventos.departamentos_id', '=', 
                'departamentos.id')
            ->join('empresas', 'eventos.departamentos_empresas_id', '=',
                'empresas.id')
            ->select('eventos.id as evento_id','eventos.nome as evento',
            'eventos.descricao as desc', 'eventos.data as data', 'departamentos.name as departamento', 'empresas.name as empresa', 'eventos.data as data')
            ->where('eventos.nome', 'like', '%'.$campo_de_pesquisa.'%')
            ->orderBy('evento_id', 'asc')
            ->paginate(10);


            //Passando a data atual para compará-la com a do evento na view.
            $hoje = Carbon\Carbon::today();
            $hoje->toDateTimeString();

            $dados = [
                'page'              => 'clientes.cliente_resultados_pesquisa',
                'eventos'           => $eventos,
                'hoje'              =>$hoje,
                'campo_de_pesquisa' => $campo_de_pesquisa,
            ];

        return view('clientes.clientes_template2', $dados);        
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
                        'empresas_id as empresa_id',
                        'empresas.name as empresa',
                        'departamentos_id as departamento_id', 
                        'departamentos.name as departamento' 
                    )
            ->orderBy('data', 'desc')
            ->paginate(10);

        //Passando a data atual para compará-la com a do evento na view.
        $hoje = Carbon\Carbon::today();
        $hoje->toDateTimeString();

        if(isset($id))
        {
         $evento = Evento::findOrFail($id);
        $dados=[
            'page' => 'clientes.clientes_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'confirmar' => DB::table('eventos')
                    ->where('id', $id)
                    ->get(), 
            'hoje' => $hoje,
        ];
        }else{
            $dados=[
            'page' => 'clientes.clientes_eventos',
            'users' =>  $users,
            'empresas' => $empresas,
            'departamentos' => $departamentos,
            'eventos' => $eventos,
            'hoje' => $hoje,
        ];
        }
        return view ('clientes.clientes_template2', $dados); 
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
            'page'              =>'clientes.clientes_evento_estatisticas',
            'eventos'           =>$eventos,
            'evento'            =>$evento,
            'campos'            =>$campos,
            'campos_adicionais' => $campos_adicionais,
            'inscritos'         => $inscritos,
        ];
        return view ('clientes.clientes_template2', $dados);
    }

    public function inscrever($id, Request $request)
    {
        $relacionamento = [
            'eventos_id'                        => $id,
            'eventos_departamentos_id'          => $request['eventos_departamentos_id'],
            'eventos_departamentos_empresas_id' => $request['eventos_departamentos_empresas_id'],
            'cliente_id' =>  $request['clientes_id'], 
        ];


        $evento = DB::table('eventos')
                    ->where('id', $id)
                    ->get();

/**

        $relacionamento = DB::table('eventos_has_clientes')->insert([
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


*/

        $campos = DB::getSchemaBuilder()->getColumnListing('clientes');
        $campos_adicionais = DB::table('extra_campos')
                                ->where('eventos_id', $id)
                                ->get();

        $dados =[
            'page' => 'clientes.cliente_evento_inscrever',
            'campos'            =>$campos,
            'campos_adicionais' => $campos_adicionais,
            'relacionamento'    =>$relacionamento,
        ];


        return view("clientes.clientes_template2", $dados);
    }


}//Fechamento Início
