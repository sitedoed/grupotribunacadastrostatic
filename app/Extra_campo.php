<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra_campo extends Model
{
    protected $fillable = [
    	'name',
    	'eventos_id',
    	'eventos_departamentos_id',
    	'eventos_departamentos_empresas_id',
    ];


    public function listar()
    {
    	return $this->hasMany('App\Campo');
    }
}
