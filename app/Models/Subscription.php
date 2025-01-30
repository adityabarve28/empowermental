<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $fillable = ['institute_id', 'plan_id', 'start_date', 'end_date', 'amount', 'acc_man_id', 'therapist_id'];

    // Define relationship to Institute
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'id');
    }

    // Define relationship to Plan
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id'); // Assuming you have a Plan model
    }
    // Define relationship with Counselor
    public function counselor()
    {
        return $this->belongsTo(Counselors::class, 'therapist_id');
    }
    // Define relationship to Counselor (therapist)
    public function therapist()
    {
        return $this->belongsTo(Counselors::class, 'therapist_id'); // Adjust 'therapist_id' as needed
    }
}
