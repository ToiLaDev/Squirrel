<?php

namespace App\Notifications\Admin;

use Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * The callback that should be used to create the reset password URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback = [self::class, 'createActionUrl'];

    public static function createActionUrl($notifiable, $token)
    {
        return url(route('admins.password.reset', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
