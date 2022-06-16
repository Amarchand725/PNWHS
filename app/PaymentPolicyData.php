<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPolicyData extends Model
{
    //
    protected $table = 'payment_policy_data';
	  
	protected $fillable = [
        'id', 'payment_policy_id', 'effective_date', 'rank_id'
    ];

    public function hasPaymentPolicy()
    {
        return $this->hasOne(PaymentPolicy::class, 'id', 'payment_policy_id');
    }
    public function hasRank()
    {
        return $this->hasOne(Rank::class, 'id', 'rank_id');
    }
}