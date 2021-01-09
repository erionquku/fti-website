<?php


namespace App\Controllers;

use App\Repositories\Classes\AnnouncementRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;

class AnnouncementController extends BaseController
{

    public static function find($id) {
        $announcementRepository = new AnnouncementRepository();
        exit(json_encode($announcementRepository->find($id)));
    }

    public static function store($request, $user) {
        if ($user->role_type_id == 2 || $user->role_type_id == 3) {

            $announcementRepo = new AnnouncementRepository();

            $announcement = array('title' => $request['title'],
                                'body' => $request['body'],
                                'uploader_id' => $user->id);

            if ($announcementRepo->store($announcement))
                echo json_encode(array('status' => 'success'));
            else
                echo json_encode(array('status' => 'failed', 'message' => 'Please try again later'));

        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'You do not have permission for this operation'));
        }
    }

    public static function findAll() {
        $announcementRepository = new AnnouncementRepository();
        $userRepo = new UserRepository();
        $announcements = $announcementRepository->all();
        foreach ($announcements as $announcement) {
            $user = $userRepo->find($announcement->uploader_id);
            $announcement->uploader = $user;
            $allAnnouncements[] = $announcement;
        }
        return $allAnnouncements;
    }

}