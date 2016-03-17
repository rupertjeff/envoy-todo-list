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
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
