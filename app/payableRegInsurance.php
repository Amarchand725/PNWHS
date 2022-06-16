<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payableRegInsurance extends Model
{
    //

    protected $table = 'payable_reg_insurances';
    protected $guarded = [];

    public function hasPaymentPolicy()
    {
        return $this->hasOne(PaymentPolicy::class, 'id', 'policy_id');
    }
}
