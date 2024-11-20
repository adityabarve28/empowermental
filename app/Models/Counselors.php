<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counselors extends Model
{
    protected $table = "counselors";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'email', 'other_fields']; // Add other fields as necessary

    // Define the relationship to the subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'therapist_id'); // Ensure 'therapist_id' is correct
    }
}
