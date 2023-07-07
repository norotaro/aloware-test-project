<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'user' => $this->user,
            'message' => $this->message,
            'level' => $this->level,
            'date' => $this->created_at,
            'edited' => $this->edited,
            'comments' => self::collection($this->comments),
        ];
    }
}
