<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneUserToCoupon extends Model {

	public function coupon()
    {
        return $this->hasOne('App\Models\AdminCoupon', 'id', 'coupon_id');
    }

}
