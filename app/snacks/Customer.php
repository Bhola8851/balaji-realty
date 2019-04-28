<?php

namespace App\snacks;

use Illuminate\Database\Eloquent\Model;
use App\snacks\CustomerMaterial;

class Customer extends Model
{
    protected $fillable = [
        'customer_name','customer_contact','customer_email','customer_address','customer_description'
    ];

    public function customer_materials(){
        return $this->hasMany(CustomerMaterial::class);
    }
}
