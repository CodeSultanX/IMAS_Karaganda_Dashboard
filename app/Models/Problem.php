<?php

namespace App\Models;
use App\Models\ProblemResult;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Problem extends Model
{
    use HasFactory, Notifiable,Filterable;

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
    public static function getAdminPageProblemsWithIds($ids)
    {
        return self::with(['images', 'results.user', 'regions'])->whereIn('id',$ids)->get();
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

    public function task(): HasOne
    {
        return $this->hasOne(ProblemNote::class,'problem_id','id');
    }
}
