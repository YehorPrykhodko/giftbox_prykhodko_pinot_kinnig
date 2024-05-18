<?php
namespace gift\appli\models;
class Box extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'box';
	protected  $primaryKey = 'id';
	public $timestamps = false;
	protected $keyType = 'string';
	use \Illuminate\Database\Eloquent\Concerns\HasUuids;

	public function prestations(){
		return $this->belongsToMany('gift\appli\models\Prestation','box2presta','box_id','presta_id')->withPivot(["quantite"]);
		// return $this->belongsToMany('rugby\models\Matchs','arbitrer','numArbitre','numMatch');

	}

	public function user(){
		return $this->belongsTo('gift\appli\models\User','createur_id');
	}
}
