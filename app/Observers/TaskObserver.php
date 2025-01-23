<?php

namespace App\Observers;

use App\Jobs\AppendToGoogleSheetsJob;
use App\Models\Task;
use App\Notifications\TaskCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        if (Storage::fileExists('app/private/google-service-account.json')) {
            AppendToGoogleSheetsJob::dispatch(
                config('services.sheets.notifications.spreadsheet_id'),
                config('services.sheets.notifications.list_name'),
                [
                    [
                        $task->title,
                        $task->description,
                        $task->is_completed ? 'Yes' : 'No',
                        $task->due_date->format('Y-m-d')
                    ],
                ],
            );
        }

        Notification::route('telegram', config('services.telegram.notifications.chat_id'))
            ->notify(new TaskCreated($task->title));
    }
}
