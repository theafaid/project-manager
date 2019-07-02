<?php

namespace App\Services\Projects;

class UpdateProjectService
{
    public function handle($project, $data)
    {
        $project->update([
            'title' => $title = $data['title'] ?: $project->title,
            'slug' => $data['title'] ? \Str::slug($title) : $project->slug,
            'description' => $data['description'] ?: $project->description,
            'notes' => $data['notes'] ?: $project->notes
        ]);

        return $project;
    }
}
