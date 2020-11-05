<?php

namespace App\Http\Services;

use Symfony\Component\HttpFoundation\Request;
use App\Notifications\SendEmail;
use App\Models\User;

class SendGridService implements SendEmailInterface
{

    public function sendEmail(User $user, $data)
    {
        if (array_key_exists("link", $data)) {
            return $user->notify(new SendEmail(config("sendgrid." . app()->getLocale() . ".mailTemplateWithUrl"),
                $data));
        }

        return $user->notify(new SendEmail(config("sendgrid." . app()->getLocale() . ".mailTemplate"), $data));

    }


}
