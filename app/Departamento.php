<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
    	'id',
    	'name',
    	'empresas_id',
    ];


    public function listar()
    {
    	return $this->hasMany('App\Departamento');
    }

    public function scopeDepartamentos_por_empresa($query, $id)
    {
    	return $query   ->where('empresas_id', $id)
                        ->get();
    }
    public function scopeDepartamento_da_empresa($query, $departamento_id)
    {
        return $query   ->where('departamentos.id', $departamento_id)
                        ->join('empresas', 'empresas.id', '=', 'departamentos.empresas_id')
                        ->get();
    }



}//fechamento final
