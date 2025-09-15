<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'description',
        'order'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}