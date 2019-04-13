<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Supplier;

class Material extends Model
{
    protected $fillable = [
        'user_id','material','brand','quantity','price','description','status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function suppliers(){
        return $this->hasMany(Supplier::class);
    }
}
