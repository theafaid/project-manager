<?php

namespace App\Services\Projects;


class UpdateTaskService
{
    public function handle($task, $data)
    {
        $task->update([
            'body' => $data['body'],
            'completed_at' => $this->completed($data['completed']) ? now() : null,
        ]);
    }

    private function completed($status)
    {
        return ! is_null($status) && $status == true;
    }
}
