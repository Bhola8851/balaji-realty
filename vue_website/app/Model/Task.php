<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
    protected $fillable = [
        'title','user_id','address','customer_phone','date','description','status'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
