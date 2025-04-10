<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProblemNote extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class, 'problem_id', 'id');
    }

}
