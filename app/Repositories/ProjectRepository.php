<?php
namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function __call($name, $arguments)
    {
        return $this->project->$name(...$arguments);
    }
}
