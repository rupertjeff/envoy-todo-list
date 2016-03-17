<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'name', 'description'];
}
