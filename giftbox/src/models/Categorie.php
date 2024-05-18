<?php
namespace gift\appli\models;
class Categorie extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'categorie';
	protected $primaryKey = 'id';
	public $timestamps = false;
	public $keyType="int";

	public function prestations(){
		return $this->hasMany('gift\appli\models\Prestation','cat_id');
	}
}
