<?php
declare(strict_types=1);
namespace App\Models\Traits;

use App\Http\Fillters\Fillter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable{

    public function scopeFilter(Builder $builder,Fillter $fillter): Builder
    {
      return $fillter->apply($builder);
    }
}