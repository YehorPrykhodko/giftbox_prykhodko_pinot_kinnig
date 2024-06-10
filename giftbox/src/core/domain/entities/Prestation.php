<?php

namespace gift\appli\core\domain\entities;
class Prestation extends \Illuminate\Database\Eloquent\Model
{
    /*
+-------------+---------------+------+-----+---------+-------+
| Field       | Type          | Null | Key | Default | Extra |
+-------------+---------------+------+-----+---------+-------+
| id          | varchar(128)  | NO   |     | NULL    |       |
| libelle     | varchar(128)  | NO   |     | NULL    |       |
| description | text          | NO   |     | NULL    |       |
| url         | varchar(256)  | YES  |     | NULL    |       |
| unite       | varchar(128)  | YES  |     | NULL    |       |
| tarif       | decimal(10,2) | NO   |     | NULL    |       |
| img         | varchar(128)  | NO   |     | NULL    |       |
| cat_id      | int(11)       | NO   |     | NULL    |       |
+-------------+---------------+------+-----+---------+-------+
     */
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $keyType = 'string';
    public $fillable = ['libelle',
        'description',
        'url',
        'unite',
        'tarif',
        'img',
        'cat_id'];

    public function boxs()
    {
        return $this->belongsToMany('gift\appli\core\domain\entities\Box', "box2presta", "presta_id", "box_id");
    }



    public function categorie()
    {
        return $this->belongsTo('gift\appli\core\domain\entities\Categorie', "cat_id");
    }
}
