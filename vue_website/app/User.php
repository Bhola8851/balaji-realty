<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use App\Model\Task;
use App\Model\Supplier;
use App\Model\Material;
use Cache;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','bio','photo','type','address','phone','gender','dob','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOnline(){
        return Cache::has('user-is-online-' . $this->id);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function suppliers(){
        return $this->hasMany(Supplier::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function materials(){
        return $this->hasMany(Material::class);
    }
}
