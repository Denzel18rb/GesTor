<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'description',
        'state',
        'deadline',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
