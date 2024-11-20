<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $primaryKey = "id"; // Corrected capitalization

    // Ensure the model has the right properties
    protected $fillable = ['name', 'email', 'institute_id', 'user_id']; // Add other fields as necessary
}
