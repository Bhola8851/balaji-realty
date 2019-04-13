<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Material;

class Supplier extends Model
{
    protected $fillable = [
        'user_id','assigned_by','material','brand','quantity','price','address','date','description','status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
