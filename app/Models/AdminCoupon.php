<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCoupon extends Model {

	//
    public function user()
    {
        return $this->hasOne('App\Models\AdminUser', 'coupon_id', 'id');
    }

}
