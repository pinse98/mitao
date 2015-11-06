<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneUser extends Model {

	public function shipping()
    {
        return $this->hasOne('App\Models\PhoneUserShipping', 'user_id');
    }

    public function coupons()
    {
        return $this->hasMany('App\Models\PhoneUserToCoupon', 'user_id');
    }

}
