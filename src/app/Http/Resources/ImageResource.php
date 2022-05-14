<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use Storage;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $my_file =Storage::path('public/'.$this->path);
        $bool = Storage::exists('public/'.$this->path);
        if($bool){
            $encoded_image = base64_encode(file_get_contents($my_file));
        } else {
            $encoded_image = false;
        }
        return [
            'image_id' => $this->id,
            'title' => $this->title,
            'content' => $encoded_image,
        ];
    }
}
