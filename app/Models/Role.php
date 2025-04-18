<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    
}
