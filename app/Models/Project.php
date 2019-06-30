<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'owner_id'
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
