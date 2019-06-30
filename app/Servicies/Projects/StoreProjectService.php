<?php

namespace App\Servicies\Projects;

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
        $this->project->create([
            'title' => $data['title'],
            'slug' => \Str::slug($data['title']),
            'description' => $data['description'],
            'owner_id' => $data['owner_id']
        ]);
    }

    private function handleData($data)
    {
        return [
            'title' => $data['title'],
            'slug' => \Str::slug($data['title']),
            'description' => $data['description'],
            'owner_id' => $data['owner_id']
        ];
    }
}
