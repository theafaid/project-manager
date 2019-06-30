<?php

namespace App\Http\Controllers;

use App\Servicies\Projects\StoreTaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Project;

class ProjectTasksController extends Controller
{
    public function __invoke(Project $project, StoreTaskRequest $request)
    {
        $this->authorize('update', $project);

        app(StoreTaskService::class)->handle(
            $project,
            $request->validated()
        );

        return redirect()->route('projects.show', $project->slug);
    }
}
