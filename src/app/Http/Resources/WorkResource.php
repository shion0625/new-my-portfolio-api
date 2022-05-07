<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;

class WorkResource extends JsonResource
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
            'data'=> [
                'type' => 'work',
                'genre' => $this->genre,
                'attribute'=>[
                    'title' => $this->title,
                    'summary' => $this->summary,
                    'period' => $this->period,
                    'number' => $this->number,
                    'language' => $this->language,
                    'comment' => $this->comment,
                    'url' => $this->url,
                    'created' => $this->created_at,
                    'updated' => $this->updated_at
                ],
                'image' => ImageResource::collection($this->images->all())
            ],
        ];
    }
}
