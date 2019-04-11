<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function Cities()
    {
        return $this->hasMany(City::class);
    }
}
