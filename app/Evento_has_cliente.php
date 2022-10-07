<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento_has_cliente extends Model
{
    protected $table = 'eventos_has_clientes';

    public function scopeNumero_de_inscritos($query, $eventos_id)
    {
    	return $query->where('eventos_id', $eventos_id)->count();
    }

    public function scopeInscritos_por_empresa($query, $empresa_id)
    {
    	return $query->where('eventos_departamentos_id', $empresa_id)->count();
    }

    public function scopeInscritos_por_departamento ($query, $eventos_departamentos_id)
    {
    	return $query->where('eventos_departamentos_id', $eventos_departamentos_id)->count();
    }
}//fechamento Inicial
