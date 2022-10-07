<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
    	'assunto',
    	'mensagem',
    	'de_user_id',
    	'para_user_id',
    	'status',
    	'created_at',
    	'updated_at',
    	'users_id',
    ];

    public function scopeFeedback($query, $id)
    {
        return $query   ->where('feedback.id', '=', $id)
                        ->join('users', 'users.id', '=', 'feedback.de_user_id')
                        ->select(
                            'feedback.id as feedback_id',
                            'feedback.assunto as assunto',
                            'feedback.mensagem as mensagem',
                            'feedback.status as status',
                            'feedback.created_at as created_at',
                            'users.name as nome')
                        ->orderBy('feedback.created_at', 'desc')
                        ->get();
    }

    public function scopeAviso_feedback($query, $id)
    {
        return $query   ->where('para_user_id', $id)
                        ->where('status', NULL)
                        ->count();
    }

    public function scopeFeedbacks_enviados($query, $user_id)
    {
        return $query   ->where('de_user_id', $user_id)
                        ->join('users', 'users.id', '=', 'feedback.de_user_id')
                        ->select(
                            'feedback.id as feedback_id',
                            'feedback.assunto as assunto',
                            'feedback.mensagem as mensagem',
                            'feedback.status as status',
                            'feedback.created_at as created_at',
                            'feedback.updated_at as updated_at',
                            'users.name as para')
                        ->orderBy('feedback.created_at', 'desc')
                        ->get();
    }

    public function scopeFeedbacks_recebidos($query, $user_id)
    {
        return $query   ->where('para_user_id', $user_id)
                        ->join('users', 'users.id', '=', 'feedback.de_user_id')
                        ->select(
                            'feedback.id as feedback_id',
                            'feedback.de_user_id as de_user_id',
                            'feedback.para_user_id as para_user_id',
                            'feedback.assunto as assunto',
                            'feedback.mensagem as mensagem',
                            'feedback.status as status',
                            'feedback.created_at as created_at',
                            'feedback.updated_at as updated_at',
                            'users.name as de')
                        ->orderBy('feedback.created_at', 'desc')
                        ->get();
    }

     public function scopeFeedbacks_todos($query, $user_id)
    {
        return $query   ->where('para_user_id', $user_id)
                        ->orwhere('de_user_id', $user_id)
                        ->join('users', 'users.id', '=', 'feedback.de_user_id')
                        ->select(
                            'feedback.id as feedback_id',
                            'feedback.de_user_id as de_user_id',
                            'feedback.para_user_id as para_user_id',
                            'feedback.assunto as assunto',
                            'feedback.mensagem as mensagem',
                            'feedback.status as status',
                            'feedback.created_at as created_at',
                            'feedback.updated_at as updated_at',
                            'users.name as nome')
                        ->orderBy('feedback.created_at', 'desc')
                        ->get();
    }   

    public function scopeFeedback_responder($query, $id)
    {
        return $query   ->where('feedback.id', $id)
                        ->join('users', 'users.id', '=', 'feedback.de_user_id')
                        ->select(
                            'feedback.id as feedback_id',
                            'feedback.de_user_id as de_user_id',
                            'feedback.para_user_id as para_user_id',
                            'feedback.assunto as assunto',
                            'feedback.mensagem as mensagem',
                            'feedback.status as status',
                            'feedback.created_at as created_at',
                            'feedback.updated_at as updated_at',
                            'users.name as nome')
                        ->orderBy('feedback.created_at', 'desc')
                        ->get();
    }
    
    public function scopeNome_para($query, $feedback_id)
    {
        return $query   ->where('feedback.id', $feedback_id)
                        ->join ('users', 'users.id', '=', 'feedback.para_user_id')
                        ->select(
                            'users.name as para'
                        )
                        ->orderBy('feedback.created_at', 'desc')
                        ->get();  
    }

}//Fechamento Inicial
