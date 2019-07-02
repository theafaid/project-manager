<?php

namespace App\Services\Projects;

use App\Models\Project;

class StoreProjectService
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function handle($data)
    {
        return $this->project->create($this->handleData($data));
    }

    private function handleData($data)
    {
        return [
            'title' => $data['title'],
            'slug' => \Str::slug($data['title']),
            'description' => $data['description'],
            'notes' => $data['notes'],
            'owner_id' => auth()->id()
        ];
    }
}
