<?php

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
        'title'
    ];
    public function work(){
        return $this->belongsTo(Work::class);
    }
}
