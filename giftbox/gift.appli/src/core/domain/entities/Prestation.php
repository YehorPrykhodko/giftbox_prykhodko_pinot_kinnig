<?php

namespace gift\appli\core\domain\entities;

class Prestation extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    public function boxes()
    {
        return $this->belongsToMany(Box::class, 'box2presta' ,'box_id', 'presta_id')
            ->withPivot('quantite');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'cat_id', 'id');
    }
}