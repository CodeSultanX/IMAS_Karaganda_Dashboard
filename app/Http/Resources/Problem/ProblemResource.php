<?php

namespace App\Http\Resources\Problem;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProblemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'level' => $this->level,
            'project_id' => $this->project_id,
            'username' => $this->results->pluck('username'),
            'is_visible' => $this->is_visible,
            'result' => $this->results->pluck('result')->implode(', '),
            'status' => $this->results->pluck('status')->implode(', '),
            'images' => $this->images->pluck('image'),
            'cities' => $this->cities->pluck('name')->implode(', '),
            'created_at' => (new DateTime(($this->created_at)))->format('Y-m-d'),
        ];
    }
}
