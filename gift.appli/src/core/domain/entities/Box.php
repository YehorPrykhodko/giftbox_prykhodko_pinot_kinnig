<?php
namespace gift\appli\core\domain\entities;
use gift\appli\core\domain\entities\Prestation;

class Box extends \Illuminate\Database\Eloquent\Model
{

    const CREATED = 1;
    const VALIDATED = 2;
    const PAYED = 3;
    const USED = 4;
    protected $table = 'box';
	protected  $primaryKey = 'id';
	public $timestamps = true;
	protected $keyType = 'string';
	use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    /*
+-------------+---------------+------+-----+---------------------+-------+
| Field       | Type          | Null | Key | Default             | Extra |
+-------------+---------------+------+-----+---------------------+-------+
| id          | varchar(128)  | NO   |     | NULL                |       |
| token       | varchar(64)   | NO   |     | NULL                |       |
| libelle     | varchar(128)  | NO   |     | NULL                |       |
| description | text          | YES  |     | NULL                |       |
| montant     | decimal(12,2) | YES  |     | 0.00                |       |
| kdo         | tinyint(4)    | NO   |     | 0                   |       |
| message_kdo | text          | YES  |     | ''                  |       |
| statut      | int(11)       | NO   |     | 1                   |       |
| created_at  | datetime      | YES  |     | 0000-00-00 00:00:00 |       |
| updated_at  | datetime      | YES  |     | NULL                |       |
| createur_id | varchar(128)  | YES  |     | NULL                |       |
+-------------+---------------+------+-----+---------------------+-------+
     */

	public function prestations(){
		return $this->belongsToMany('gift\appli\core\domain\entities\Prestation','box2presta','box_id','presta_id')->withPivot(["quantite"]);
		// return $this->belongsToMany('rugby\models\Matchs','arbitrer','numArbitre','numMatch');

	}

	public function user(){
		return $this->belongsTo('gift\appli\core\domain\entities\User','createur_id');
	}
}
