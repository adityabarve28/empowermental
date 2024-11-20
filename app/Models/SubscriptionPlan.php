<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    protected $table = "subscription_plans";
    protected $primarykey = "id";
    protected $fillable = ['name', 'price', 'features', 'discount'];
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'id');
    }
}
