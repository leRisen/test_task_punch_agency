<?php

namespace App\Jobs;

use App\Services\GoogleSheetsService;
use Google\Service\Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AppendToGoogleSheetsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string|null $spreadsheetId,
        private readonly string|null $range,
        private readonly array $values,
    )
    {
        //
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(GoogleSheetsService $googleSheetsService): void
    {
        if (!$this->spreadsheetId || !$this->range) {
            return;
        }

        $googleSheetsService->appendRows($this->spreadsheetId, $this->range, $this->values);
    }
}
