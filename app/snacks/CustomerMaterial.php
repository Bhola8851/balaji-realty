<?php

namespace App\snacks;

use Illuminate\Database\Eloquent\Model;
use App\snacks\Customer;

class CustomerMaterial extends Model
{
    protected $fillable = [
        'material_name','material_quantity'
    ];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
