<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class Feedbacks extends Model
{
    protected $table = "feedbacks";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'role',
        'feedback',
        'to_id',
        'to_name',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
