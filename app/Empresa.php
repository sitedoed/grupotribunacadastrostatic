<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
    	'name',
    ];

    public function scopeEmpresa($query, $id)
    {
        return $query   ->where('id', $id)
                        ->get();
    }

    public function scopeEmpresas ($query)
    {
    	return $query   ->join('departamentos', 'empresas.id', '=', 'departamentos.empresas_id')
                    	->join('eventos', 'eventos.departamentos_empresas_id', '=', 'eventos.id')
                    	->select('empresas.id as empresas_id', 'empresas.name as empresa', 'departamentos.id as departamentos_id', 'departamentos.name as departamento','eventos.nome as evento' 
                    	)
                    	->orderBy('empresa')
                    	->get();
    }

    public function scopeEmpresa_por_id($query, $id)
    {
        return $query   ->where('id', $id)
                        ->get();
    }

}//fechamento Inicial

