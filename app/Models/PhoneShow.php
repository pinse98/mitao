<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneShow extends Model {

	public function product()
    {
        return $this->hasOne('App\Models\PhoneProduct', 'id', 'product_id');
    }

    public function detailsClass()
    {
        return $this->hasOne('App\Models\PhoneShowTabColor', 'id', 'details_class');
    }

}
