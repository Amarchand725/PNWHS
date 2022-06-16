<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseCategory extends Model
{
    //
    protected $table = 'house_categories';
    protected $guarded = [];

    public function hasPolicies()
    {
        return $this->hasMany(PaymentPolicy::class, 'cat_id', 'id');
    }
}
