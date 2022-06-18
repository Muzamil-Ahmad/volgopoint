<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Role extends Model
{
    protected $table = "role";
    protected $fillable = [
        'user_role'
    ];
    
    public function User()
{
    return $this->belongsTo('App\User', 'role_id');
}
    
}
