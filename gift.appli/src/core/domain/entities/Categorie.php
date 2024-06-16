<?php
namespace gift\appli\core\domain\entities;
class Categorie extends \Illuminate\Database\Eloquent\Model
{
    /*
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| libelle     | varchar(128) | NO   |     | NULL    |                |
| description | text         | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
     */
	protected $table = 'categorie';
	protected $primaryKey = 'id';
	public $timestamps = false;
	public $keyType="int";


	public function prestations(){
		return $this->hasMany('gift\appli\core\domain\entities\Prestation','cat_id');
	}

}
