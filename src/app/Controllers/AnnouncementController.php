<?php


namespace App\Controllers;

use App\Repositories\Classes\NotificationRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;

class NotificationController extends BaseController
{

    public static function find($id) {
        $notificationRepository = new NotificationRepository();
        exit(json_encode($notificationRepository->find($id)));
    }

    public static function findAll() {
        $notificationRepository = new NotificationRepository();
        $userRepo = new UserRepository();
        $notifications = $notificationRepository->all();
        foreach ($notifications as $notification) {
            $user = $userRepo->find($notification->uploader_id);
            $notification->uploader = $user;
            $allNotifications[] = $notification;
        }
        return $allNotifications;
    }

}