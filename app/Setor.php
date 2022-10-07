<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{

    protected $table = 'setor';

    protected $fillable = [
        'setor',
    ];

    public function scopeSetor_por_id($query, $id)
    {
    	return $query 	->where('id', $id)
                    	->get();
    }

}//fechamento Inicio
