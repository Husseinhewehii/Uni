<?php

namespace App\Http\Services;

use App\Models\User;

interface SendEmailInterface
{
    public function sendEmail(User $user, $data);
}
