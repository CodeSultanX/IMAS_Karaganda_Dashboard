<?php

namespace App\Http\Resources\Project;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [   
            'title' => $this->title,
            'f_date' => (new \DateTime($this->f_date))->format('Y-m-d'),
            's_date' => (new \DateTime($this->s_date))->format('Y-m-d'),
        ];
    }
}
