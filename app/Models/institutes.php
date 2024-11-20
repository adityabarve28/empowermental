<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class institutes extends Model
{
    protected $table = "institutes";
    protected $primaryKey = "id";

    // Define relationship to Subscription
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'id');
    }
}
