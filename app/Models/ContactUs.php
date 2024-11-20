<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = "contactus";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'email', 'message'];
}
