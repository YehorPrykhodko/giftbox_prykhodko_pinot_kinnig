<?php

namespace gift\appli\models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    public function box()
    {
        return $this->hasMany(Box::class, 'createur_id', 'id');
    }
}