<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    //use SoftDeletes;

    protected $fillable = ['title', 'created_at'];

    public function profiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function scopeFilterBy($query, QueryFilter $filters, array $data)
    {
        return $filters->applyto($query, $data);
    }
}
