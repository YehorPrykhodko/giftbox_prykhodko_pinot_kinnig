<?php

namespace gift\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Box extends \Illuminate\Database\Eloquent\Model
{
    use HasUuids;
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'createur_id', 'id');
    }
    
    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }

}