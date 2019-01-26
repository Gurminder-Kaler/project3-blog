<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //
    protected $fillable =[ 'title','created_at','slug'];
    public function discussions(){
        return $this->hasMany('App\Discussion');
    }
}
