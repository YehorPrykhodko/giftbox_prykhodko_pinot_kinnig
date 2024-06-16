<?php

namespace gift\api\core\domain\entities;
class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function prestation()
    {
        return $this->hasMany(Prestation::class, 'cat_id', 'id');
    }
}