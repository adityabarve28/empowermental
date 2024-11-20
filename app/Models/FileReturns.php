<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FileReturns extends Model
{
    use HasFactory;
    protected $table = "filereturns";
    protected $primaryKey = "id";
    protected $fillable = [
        'counselor_id', 
        'travel_date', 
        'travel_location', 
        'description', 
        'screenshots', 
        'status'
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }
    public function counselorr()
    {
        return $this->belongsTo(Counselors::class, 'counselor_id');
    }
}
