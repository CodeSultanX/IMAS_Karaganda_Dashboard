<?php

namespace App\Http\Fillters;
use Illuminate\Database\Eloquent\Builder;


class ProblemFillter extends Fillter
{
    public const KEYS_STRING_TO_ARRAY = ['levels', 'regions'];

    protected function levels(array $value): Builder
    {
       return $this->builder->whereIn('level',$value);
    }
    protected function regions(array $value): Builder
    {
        return $this->builder->whereHas('regions',function($b) use ($value){
            $b->whereIn('region_id',$value);
        });
    }
    protected function visible(string $value): Builder
    {
       return  $this->builder->where('is_visible',$value);
    }
    protected function fDate($value): Builder
    {
       return $this->builder->whereDate('created_at','>=',$value);
    }
    protected function sDate($value): Builder
    {
       return $this->builder->whereDate('created_at','<=',$value);
    }
}