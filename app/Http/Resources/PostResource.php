<?php

namespace App\Http\Resources;

use App\Helpers\HashId;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => HashId::hashid_decode($this->id),
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated' => $this->updated_at->diffForHumans(),
            'created' => $this->created_at->diffForHumans()
        ];
    }
}
