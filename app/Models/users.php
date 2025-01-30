<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $primarykey = "id";
    public function student()
{
    return $this->hasOne(Student::class, 'user_id');
}
}
