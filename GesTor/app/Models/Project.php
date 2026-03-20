<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'end_date',
        'team_members_count',
        'tasks_count',
        'user_id'
    ];

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class, 'project_id');
    }
}