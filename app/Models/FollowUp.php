<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    protected $table = "followup";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'location', 'phone_number', 'date_of_appointment', 'role', 'appointment_type'];
}
