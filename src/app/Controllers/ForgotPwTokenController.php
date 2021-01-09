<?php


namespace App\Controllers;

use App\Repositories\Classes\ForgotPwTokenRepository;
use App\Repositories\Classes\RegistrationTokenRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;
use DateInterval;
use DateTime;

class ForgotPwTokenController extends BaseController
{

    public static function getbyToken($token)
    {
        $tokenRepo = new ForgotPwTokenRepository();
        return $tokenRepo->findBy('token', $token);
    }

    public static function createToken($email)
    {
        if (!isset($email) || empty($email))
            exit(json_encode(array('success' => false, 'message' => 'Please enter your email!')));

        $userRepo = new UserRepository();
        $userCount = $userRepo->countBy('email', $email);
        $user = $userRepo->findBy('email', $email);

        if ($userCount == 0 || $user == null) {
            exit(json_encode(array("success"=> false, "message" => "This email has not been registered!")));
        }


        $now = new DateTime();
        $exp = (new DateTime())->add(new DateInterval("PT1H"));

        $tokenRepo = new ForgotPwTokenRepository();
        $randomToken = bin2hex(random_bytes(128));
        $token = array("user_id" => $user->id,
            "token" => $randomToken,
            "created_at" => $now->format('Y-m-d H:i:s'),
            "expires_at" => $exp->format('Y-m-d H:i:s'));

        if ($tokenRepo->store($token)) {
            exit(json_encode(array("success" => true,
                "message" => "Sucessfully created token",
                "title" => "Reset Password!",
                "body" => self::generateEmailBody($email, $randomToken, $user))));
        }

        exit(json_encode(array("success"=> false, "message" => "Please try again later")));
    }

    private function generateEmailBody($email, $token, $user)
    {
        $url = str_replace(":token", $token, route('forgot_password_token'));
        return  "<b>From:</b> info@fti.upt.al<br>".
            "<b>To:</b> $email<br>".
            "<b>Subject:</b> Password Reset!<br><br><br>".
            "<p>Dear $user->first_name $user->last_name,<br>".
            "Please click below link in order to reset your password<br>".
            "This link will be available for only 1 hour.<br>".
            "You can ignore this email if you didn't request a password reset.<br></p>".
            "<a href='" . $url . "'> Click here to reset your password.</a> <br> <br>".
            "If above url doesn't work, try copying and pasting this address in browser: $url";
    }

}