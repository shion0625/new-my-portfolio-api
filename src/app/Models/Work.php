<?php declare(strict_types=1);

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

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
