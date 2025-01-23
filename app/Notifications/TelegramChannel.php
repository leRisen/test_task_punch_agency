<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;

class TelegramChannel
{
    /**
     * Create a new Slack channel instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function send(object $notifiable, Notification $notification)
    {
        if (! $chatId = $notifiable->routeNotificationFor('telegram', $notification)) {
            return;
        }

        if (! $token = config('services.telegram.notifications.token')) {
            return;
        }

        $url = "https://api.telegram.org/bot{$token}/sendMessage";
        $data = $notification->toTelegram($notifiable);

        return Http::post($url, [
            'chat_id' => $chatId,
            ...$data,
        ]);
    }
}
