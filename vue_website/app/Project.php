<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title','deal_type','price','location','address','description','user_id','cover_image',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
