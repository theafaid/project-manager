<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['body', 'project_id', 'completed_at'];
    protected $touches = ['project'];

    protected static function boot()
    {
        parent::boot();

        static::created(function($task){
            $task->project->recordActivity('created_task');

        });

        static::updated(function($task){
            $task->project->recordActivity(
                $task->completed_at ? 'completed_task' : 'incompleted_task'
            );
        });
    }
    public function hasCompleted()
    {
        return !! $this->completed_at;
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function ownsBy($user)
    {
        return $user->is($this->project->owner);
    }
}
