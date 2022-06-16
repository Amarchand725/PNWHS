<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedPolicy extends Model
{
    //
    protected $table='assigned_policies';
    protected $guarded = [];

    public function hasPaymentPolicy()
    {
        return $this->hasOne(PaymentPolicy::class, 'id', 'policy_id');
    }
}
