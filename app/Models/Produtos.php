<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model {
    protected $dates = ['deleted_at'];

	protected $fillable = ['categoria', 'titulo', 'descricao', 'codigo', 'preco', 'preco_venda', 'imagem', 'marca_id', 'tipo_id', 'cor', 'festas_id', 'adicionado'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
   
    public function tipo() {
        return $this->belongsTo('App\Models\ProdutosTipos');
    }

	public function marca() {
		return $this->belongsTo('App\Models\ProdutosMarcas');
	}

    public function lojas() {
        return $this->hasMany('App\Models\ProdutosLojas');
    }
}
