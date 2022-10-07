<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
	    protected $fillable = [
    	'resposta',
    	'de_user_id',
    	'para_user_id',
    	'feedback_id',
    	'users_id',
    ];

    public function scopeRespostas_feedback($query, $id)
    {
        return $query   ->where('respostas.feedback_id', $id)
                        ->join('users', 'users.id', '=', 'respostas.users_id')
                        ->select(
                            'respostas.id as resposta_id',
                            'respostas.resposta as resposta',
                            'respostas.feedback_id as feedback_id',
                            'users.name as nome',
                            'respostas.created_at as created_at'
                        )
                        ->get();
    }

    public function scopeRespostas_feedback_editar($query, $id)
    {
        return $query   ->where('respostas.id', $id)
                        ->join('users', 'users.id', '=', 'respostas.users_id')
                        ->select(
                            'respostas.id as resposta_id',
                            'respostas.resposta as resposta',
                            'respostas.feedback_id as feedback_id',
                            'users.name as nome',
                            'respostas.created_at as created_at'
                        )
                        ->get();
    }


}
