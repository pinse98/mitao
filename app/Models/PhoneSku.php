<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneSku extends Model {

	public function image()
    {
        return $this->hasOne('App\Models\PhoneImage', 'id', 'image_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\PhoneProduct', 'id', 'product_id');
    }

    public function network()
    {
        return $this->hasOne('App\Models\PhoneNetwork', 'id', 'network_id');
    }

    public function memory()
    {
        return $this->hasOne('App\Models\PhoneMemory', 'id', 'memory_id');
    }

    public function color()
    {
        return $this->hasOne('App\Models\PhoneColor', 'id', 'color_id');
    }

    public function storage()
    {
        return $this->hasOne('App\Models\PhoneStorage', 'id', 'storage_id');
    }

}
