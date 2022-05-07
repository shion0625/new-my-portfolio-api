<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Work extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at'
    ];

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
