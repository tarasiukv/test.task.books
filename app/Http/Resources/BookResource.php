<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'price' => $this->getPrice(),
            'status' => $this->getStatus(),
            'author_id' => $this->getAuthor()->getId(),
            'author' => new AuthorResource($this->getAuthor()),
            'publisher_id' => $this->getPublisher()->getId(),
            'publisher' => new PublisherResource($this->getPublisher()),
        ];
    }
}
