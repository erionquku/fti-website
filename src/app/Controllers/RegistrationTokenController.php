<?php


namespace App\Controllers;

use App\Models\Token\RegistrationToken;
use App\Repositories\Classes\RegistrationTokenRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;
use DateInterval;
use DateTime;

class RegistrationTokenController extends BaseController
{

    public static function getbyToken($token)
    {
        $tokenRepo = new RegistrationTokenRepository();
        return $tokenRepo->findBy('token', $token);
    }

    public static function createToken($email)
    {
        if (!isset($email) || empty($email))
            exit(json_encode(array('success' => false, 'message' => 'Please enter your email!')));

        if (strpos($email, '@') != false)
            exit(json_encode(array('success' => false, 'message' => "Email '$email@fti.edu.al' is not correct!")));

        $email = $email . "@fti.edu.al";
        $userRepo = new UserRepository();
        $userCount = $userRepo->countBy('email', $email);

        if ($userCount > 0) {
            exit(json_encode(array("success"=> false, "message" => "This email has already been registered")));
        }

        $now = new DateTime();
        $exp = (new DateTime())->add(new DateInterval("PT1H"));

        $tokenRepo = new RegistrationTokenRepository();

        $userTokens = $tokenRepo->findAllBy('email', $email);
        foreach ($userTokens as $userToken) {
            if ($userToken->expires_at > ((array)$now)['date'])
                exit(json_encode(array("success" => false, "message" => "There is an active token generated for this email. Please try again later.")));
        }

        $randomToken = bin2hex(random_bytes(128));
        $token = array("email" => $email,
                    "token" => $randomToken,
                    "created_at" => $now->format('Y-m-d H:i:s'),
                    "expires_at" => $exp->format('Y-m-d H:i:s'));

        if ($tokenRepo->store($token)) {
            exit(json_encode(array("success" => true,
                                    "message" => "Sucessfully created token",
                                    "title" => "Welcome!",
                                    "body" => self::generateEmailBody($email, $randomToken))));
        }

        exit(json_encode(array("success"=> false, "message" => "Please try again later")));
    }

    private function generateEmailBody($email, $token)
    {
        $url = str_replace(":token", $token, route('register_with_token'));
        return  "<b>From:</b> info@fti.upt.al<br>".
                "<b>To:</b> $email<br>".
                "<b>Subject:</b> Welcome to FTI new website!<br><br><br>".
                "<p>Dear Student,<br>".
                "Please click below to register to new FTI website.<br>".
                "This link will be available for only 1 hour.<br>".
                "<b>Note:</b>This link is unique to you so don't share it with anyone else.<br></p>".
                "<a href='" . $url . "'> Click here to register</a> <br> <br>".
                "If above url doesn't work, try copying and pasting this address in browser: $url";
    }

}