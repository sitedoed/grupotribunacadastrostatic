<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
    	'name',
    	'email1',
    	'email2',
    	'tel1',
    	'tel2',
    	'endereco',
    	'bairro',
    	'cidade',
    	'estado',
    	'cep',
    	'rg',
    	'cpf',
    	'sexo',
    ];


    public function listar()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function scopeClientes_do_evento ($query, $id)
    {
        return $query   ->where('eventos.id','=', $id)
                        ->join('eventos_has_clientes','clientes.id', '=', 'eventos_has_clientes.clientes_id')
                        ->join('eventos', 'eventos.id',  '=', 'eventos_has_clientes.eventos_id' )
                        ->select('clientes.id as cliente_id', 'clientes.name as name', 'clientes.email1 as email1', 'eventos.nome as evento'
                        )
                        ->orderBy('name')
                        ->paginate(10);
    }


}//fechamento final
