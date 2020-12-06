<?php


namespace App\Repositories\Classes;

use App\Models\Notification\Notification;
use Core\Repositories\Classes\BaseRepository;

class NotificationRepository extends BaseRepository
{

    public function model(): string
    {
        return Notification::class;
    }

    public function table_name(): string
    {
        return "notifications";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "title", "body", "uploader_id");
    }

}