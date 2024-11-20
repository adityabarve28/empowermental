<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = "_admins";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];
}
