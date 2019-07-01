<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Servicies\Projects\StoreTaskService;
use App\Servicies\Projects\UpdateTaskService;

class ProjectTasksController extends Controller
{
    public function store(Project $project, StoreTaskRequest $request)
    {
        $this->authorize('update', $project);

        app(StoreTaskService::class)->handle(
            $project,
            $request->validated()
        );

        return redirect()->route('projects.show', $project->slug);
    }

    public function update(Project $project, Task $task, UpdateTaskRequest $request)
    {
        $this->authorize('update', $task);

        app(UpdateTaskService::class)->handle($task, $request->validated());

        return redirect()->route('projects.show', $project);
    }
}
