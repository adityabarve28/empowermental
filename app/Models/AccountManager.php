<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountManager extends Model
{
   
    protected $table = "account_managers";
    protected $primarykey = "id";

    protected $fillable = ['name', 'phone', 'email', 'institute_id']; // Add other fields as necessary
}
