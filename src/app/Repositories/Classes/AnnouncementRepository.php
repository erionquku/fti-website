<?php


namespace App\Repositories\Classes;

use App\Models\Announcement\Announcement;
use Core\Repositories\Classes\BaseRepository;

class AnnouncementRepository extends BaseRepository
{

    public function model(): string
    {
        return Announcement::class;
    }

    public function table_name(): string
    {
        return "announcements";
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