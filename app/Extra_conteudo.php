<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra_conteudo extends Model
{
    protected $fillable = [
    	'conteudo',
    	'clientes_id',
    	'extra_campos_id',
    	'extra_campos_eventos_id',
    	'extra_campos_eventos_departamentos_id',
    	'extra_campos_eventos_departamentos_empresas_id',
    ];
}
