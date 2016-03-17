<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @package App\Database\Models
 *
 * @method static Task findOrFail($id)
 */
class Task extends Model
{
    protected $fillable = ['user_id', 'name', 'description'];
}
