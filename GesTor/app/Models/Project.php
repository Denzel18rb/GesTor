<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id_project';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'team_members_count',
        'tasks_count',
        'user_id'
    ];

    public $timestamps = true;
}