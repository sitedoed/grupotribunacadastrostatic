<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
    	'nome',
    	'descricao',
    	'data',
    	'departamentos_empresas_id',
    	'departamentos_id',
    ];

    public function scopeNome($query)
    {
    	return $query->where('nome', '!=', '');
    }

    public function scopeQuantidade_de_eventos($query, $departamentos_id)
    {
    	return $query->where('departamentos_id', $departamentos_id)->count();
    }

    public function scopeEventos_por_departamento($query, $departamentos_id)
    {
        return $query->where('departamentos_id', $departamentos_id)->get();
    }

    public function scopeEventos_por_empresa($query, $empresa_id)
    {
        return $query->where('departamentos_empresas_id', $empresa_id)
                    ->join('departamentos', 'departamentos.id', '=', 'eventos.departamentos_id')
                    ->join ('empresas', 'empresas.id', '=', 'eventos.departamentos_empresas_id')
                    ->select(   'empresas.id as empresas_id', 'empresas.name as empresa', 'departamentos.id as departamentos_id', 'departamentos.name as departamento', 'eventos.id as evento_id', 'eventos.nome as evento'
                    )
                    ->orderBy('departamento')
                    ->get();
    }

    public function scopeEventos_todos($query)
    {
        return $query->join('departamentos', 'eventos.departamentos_id', '=', 'departamentos.id')
                    ->join('empresas', 'departamentos.empresas_id', '=', 'empresas.id')
                    ->select(   'eventos.id as id',
                                'eventos.nome as nome',
                                'eventos.data as data',
                                'empresas.name as empresa',
                                'departamentos.name as departamento' 
                            )
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function scopeEvento_por_id($query, $id)
    {
        return  $query->where('id', $id)
                        ->get(); 
    }



}//fechamento inicial
