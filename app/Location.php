<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function location(){
        return $this->hasOneThrough(Location::class, Profile::class);
    }

}
