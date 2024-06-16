<?php

namespace gift\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Prestation extends \Illuminate\Database\Eloquent\Model
{
    use HasUuids;

    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;

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