<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    //

	public function scopeDadosMailing($query, $id)
	{
        return $query   ->where('mailings.id','=', $id)
		                ->join('dados_mailings','mailings.id', '=', 'dados_mailings.mailings_id')
		                ->select('mailings.titulo as titulo', 'mailings.descricao as descricao', 'dados_mailings.nome as nome', 'dados_mailings.email as email'
		                )
		                ->orderBy('mailings_id')
		                ->paginate(42);
	}



}// fechamento inicio
