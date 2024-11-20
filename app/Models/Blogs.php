<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $primarykey = "id";
    protected $fillable = [
        'therapist_id',
        'title',
        'sub_title',
        'content',
    ];
    public function therapist()
    {
        return $this->belongsTo(Counselors::class, 'therapist_id');
    }
}
