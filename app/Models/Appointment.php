<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = "appointments";
    protected $primaryKey = "id";
     // Specify the fillable attributes
     protected $fillable = [
        'counselor_id',
        'appointment_date', // Ensure this matches your column name
        'status',
        'institute_id',
    ];


    // Define the relationship to the Institute
    public function institute()
    {
        return $this->belongsTo(Institutes::class, 'institute_id');
    }

    // Define the relationship to the Counselor (assuming counselor_id is the foreign key)
    public function counselor()
    {
        return $this->belongsTo(Counselors::class, 'counselor_id');
    }
    public function counselorx()
{
    return $this->belongsTo(Counselors::class, 'counselor_id'); // Adjust 'counselor_id' as needed
}

}
