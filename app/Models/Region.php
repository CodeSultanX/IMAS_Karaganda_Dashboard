<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function problem(){
        return $this->hasMany(Problem::class);
    }
}
