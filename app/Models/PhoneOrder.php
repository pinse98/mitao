<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneOrder extends Model {

	//
    public function expresses()
    {
        return $this->hasOne('App\Models\AdminExpress', 'id', 'shipping_id');
    }

}
