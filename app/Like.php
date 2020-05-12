<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function users(){
      return $this->belongsTo('App\Users');
    }

    public function post(){
      return $this->belongsTo('App\Posts');
    }
}
