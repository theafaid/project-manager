<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'owner_id', 'notes'
    ];

    protected static function boot()
    {
        parent::boot();


    }
    public function getRouteKeyName()
    {
        return "slug";
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function recordActivity($type)
    {
        $this->activities()->create(['type' => $type]);
    }
}
