<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['body', 'project_id', 'completed_at'];
    protected $touches = ['project'];

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
