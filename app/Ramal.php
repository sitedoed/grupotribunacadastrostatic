<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ramal extends Model
{
	protected $table = 'ramal';

    protected $fillable = [
        'ramal',
        'nome',
        'status',
        'setor_id',
        'updated_at',
    ];

    public function scopeRamais_setores($query)
    {
    	return $query 	->join('setor', 'setor.id', '=', 'ramal.setor_id')
                		->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel', 'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
                		->orderBy('ramal.id', 'asc')
                		->paginate(10);
    }

    public function scopeRamal_por_status($query, $status)
    {
        return $query   ->where('status', 'like', '%'.$status.'%')
                        ->join('setor', 'setor.id', '=', 'ramal.setor_id')
		                ->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
		                'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
		                ->where('status', 'like', '%'.$status.'%')
		                ->orderBy('ramal_id', 'asc')
                        ->paginate(10);
    }

    public function scopeRamal_like_pesquisar_ramal($query, $pesquisar_ramal, $status)
    {
    	return $query	->join('setor', 'setor.id', '=', 'ramal.setor_id')
		                ->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
		                'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
		                ->where('setor', 'like', '%'.$pesquisar_ramal.'%')
		                ->orWhere('ramal', 'like', '%'.$pesquisar_ramal.'%')
		                ->orWhere('nome', 'like', '%'.$pesquisar_ramal.'%')
		                ->where('status', 'like', '%'.$status.'%')
		                ->orderBy('ramal_id', 'asc')
		                ->paginate(10);
    }

    public function scopeRamal_pesquisar_publico($query, $pesquisar_publico)
    {
    	return $query	->join('setor', 'setor.id', '=', 'ramal.setor_id')
		                ->select('ramal.id as ramal_id', 'ramal.ramal as ramal', 'ramal.nome as responsavel',
		                'ramal.status as status', 'setor.id as setor_id', 'setor.setor as setor')
		                ->where('status', '=', '1')
		                ->where('setor', 'like', '%'.$pesquisar_ramal.'%')
		                ->orWhere('ramal', 'like', '%'.$pesquisar_ramal.'%')
		                ->orWhere('nome', 'like', '%'.$pesquisar_ramal.'%')
		                ->orderBy('ramal_id', 'asc')
		                ->paginate(10);
    }

    public function scopeRamal_por_id($query, $id)
    {
    	return $query 	->join('setor', 'setor.id', '=', 'ramal.setor_id')
                		->where('ramal.id', $id)
                    	->select(
	                        'ramal.id as ramal_id',
	                        'ramal.ramal as ramal',
	                        'ramal.nome as nome',
	                        'ramal.status as status',
	                        'setor.id as setor_id',
	                        'setor.setor as setor')
                    	->get();
    }

}//fechamento Inicial

