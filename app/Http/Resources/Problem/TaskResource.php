<?php

namespace App\Http\Resources\Problem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'user_id' => $this->user_id,
            'problem_name' => $this->title,
            'type' => optional($this->task)->note_type,
            'status' => optional($this->task)->status,
            'content' => optional($this->task)->content,
            'task_id' => optional($this->task)->id,
            'is_visible' => $this->is_visible,
        ];
    }
}
