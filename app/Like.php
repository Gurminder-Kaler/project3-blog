<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable =['id','user_id','reply_id'];
    public function reply(){
        return $this->belongsTo('App\Reply');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
