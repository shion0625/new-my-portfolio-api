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
        $file_jpg =Storage::path('public/'.$this->jpg_image);
        $file_webp =Storage::path('public/'.$this->webp_image);
        $is_exist_jpg = Storage::exists('public/'.$this->jpg_image);
        $is_exist_webp = Storage::exists('public/'.$this->webp_image);
        if($is_exist_jpg && $is_exist_webp){
            $encoded_jpg = base64_encode(file_get_contents($file_jpg));
            $encoded_webp = base64_encode(file_get_contents($file_webp));
        } else {
            $encoded_jpg = false;
            $encoded_webp = false;
        }
        return [
            'image_id' => $this->id,
            'image_jpg' => $encoded_jpg,
            'image_webp' => $encoded_webp,
        ];
    }
}
