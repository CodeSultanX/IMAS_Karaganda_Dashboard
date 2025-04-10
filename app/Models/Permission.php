<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
