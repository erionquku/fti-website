<?php

namespace App\Controllers;

use App\Repositories\Classes\PersonalDataRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;

class PersonalDataController extends BaseController
{

    public static function update($id, $data)
    {
        $userRepo = new UserRepository();
        $user = $userRepo->find($id);

        $userUpdate = array();
        if ($user->first_name != $data['first_name'])
            $userUpdate['first_name'] = $data['first_name'];
        if ($user->last_name != $data['last_name'])
            $userUpdate['last_name'] = $data['last_name'];
        if ($user->email != $data['email'])
            $userUpdate['email'] = $data['email'];

        if (!empty($userUpdate))
        {
            $updated = $userRepo->update($userUpdate, $id);
            if ($updated == false)
                exit(json_encode(array("success" => false, "message" => "Something went wrong!")));
        }

        $personalRepo = new PersonalDataRepository();
        $no = $personalRepo->countBy('user_id', $id);
        if ($no > 0) {
            $status = $personalRepo->update(array(
                "gender" => $data['gender'],
                "mobile_number" => $data['mobile_number'],
                "place_of_birth" => $data['place_of_birth'],
                "date_of_birth" => $data['date_of_birth'],
                "personal_no" => $data['personal_no'],
                "registry_no" => $data['registry_no'],
                "nationality" => $data['nationality']
            ), $id);

            if ($status != false)
                exit(json_encode(array("success" => true, "message" => "Sucessfully updated!")));
            else
                exit(json_encode(array("sucess" => false, "message" => "Something went wrong!")));

        }

        else if ($no == 0)
        {

            $status = $personalRepo->store(array(
                "user_id" => $id,
                "gender" => $data['gender'],
                "mobile_number" => $data['mobile_number'],
                "place_of_birth" => $data['place_of_birth'],
                "date_of_birth" => $data['date_of_birth'],
                "personal_no" => $data['personal_no'],
                "registry_no" => $data['registry_no'],
                "nationality" => $data['nationality']
            ));

            if ($status != false)
                exit(json_encode(array("success" => true, "message" => "Sucessfully updated!")));
            else
                exit(json_encode(array("sucess" => false, "message" => "Something went wrong!")));

        }

//        if ($personalRepo->update($data, $id))
//            exit(json_encode(array("success" => true, "message" => "Sucessfully updated!")));
//        else
//            exit(json_encode(array("sucess" => false, "message" => "Something went wrong!")));
    }

}