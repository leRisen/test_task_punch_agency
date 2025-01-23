<?php

namespace App\Services;

use Google\Client;
use Google\Service\Exception;
use Google\Service\Sheets;

class GoogleSheetsService
{
    private Sheets $service;

    /**
     * @throws \Google\Exception
     */
    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/private/google-service-account.json'));
        $client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($client);
    }

    /**
     * @throws Exception
     */
    public function appendRows(string $spreadsheetId, string $range, array $values): Sheets\AppendValuesResponse
    {
        return $this->service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            new Sheets\ValueRange([
                'values' => $values,
            ]),
            ['valueInputOption' => 'RAW']
        );
    }
}
