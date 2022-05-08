<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Work;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'work_id',
    ];
    public function work(){
        return $this->belongsTo(Work::class);
    }
}
