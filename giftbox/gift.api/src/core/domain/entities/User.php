<?php

namespace gift\api\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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