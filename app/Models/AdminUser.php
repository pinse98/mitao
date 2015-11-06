<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model {

	// 关联优惠劵
    public function coupon()
    {
        return $this->hasOne('App\Models\AdminCoupon', 'id', 'coupon_id');
    }

}
