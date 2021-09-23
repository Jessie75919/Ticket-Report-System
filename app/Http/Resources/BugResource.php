<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BugResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_user' => new UserResource($this->createUser),
            'is_resolved' => $this->is_resolved,
            'summary' => $this->summary,
            'description' => $this->description,
            'status' => $this->status,
            'resolved_user' => new UserResource($this->resolveUser),
            'resolved_at' => $this->resolved_at,
        ];
    }
}
