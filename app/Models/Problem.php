<?php

namespace App\Models;
use App\Models\ProblemResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Problem extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "title",
        "result",
        "status",
        "level",
        "color",
        "project_id",
    ];

    public static function getAdminPageProblems()
    {
        return self::with(['images', 'results.user', 'regions'])->get();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProblemImage::class, 'problem_id', 'id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(ProblemResult::class, 'problem_id', 'id');
    }

    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'problem_maps', 'problem_id', 'region_id');
    }
}
