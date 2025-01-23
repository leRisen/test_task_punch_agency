# Тестовое задание "Punch Agency"

#### [Описание](TASK.md)
#### [Коллекция Postman](Test Task API.postman_collection.json)

## Инструкция к запуску

1. `git clone https://github.com/leRisen/test_task_punch_agency.git`
2. `composer install`
3. `cp .env.example .env`
4. `php artisan migrate --seed`
5. `php artisan serve`
> данные для входа (login: test, password: password)

**Не забудьте поднять очереди для работы уведомлений**
`php artisan queue:work`

## Telegram bot & Google Sheets

Google Service Account Path: `storage/app/private/google-service-account.json`
```
TELEGRAM_TOKEN=from_bot_father_token_here
TELEGRAM_CHAT_ID=chat_id_here
GOOGLE_SHEETS_LIST_NAME=Sheet1
GOOGLE_SHEETS_SPREADSHEET_ID=spreadsheet_id_here
```
