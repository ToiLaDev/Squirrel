<?php

namespace App\Listeners\Log;

use Illuminate\Support\Facades\Request;

class UserEventSubscriber
{

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Registered',
            [UserEventSubscriber::class, 'handleUserRegistered']
        );

        $events->listen(
            'Illuminate\Auth\Events\Verified',
            [UserEventSubscriber::class, 'handleUserVerified']
        );

        $events->listen(
            'Illuminate\Auth\Events\PasswordReset',
            [UserEventSubscriber::class, 'handleUserPasswordReset']
        );

        $events->listen(
            'Illuminate\Auth\Events\Login',
            [UserEventSubscriber::class, 'handleUserLogin']
        );

        $events->listen(
            'Illuminate\Auth\Events\Failed',
            [UserEventSubscriber::class, 'handleUserFailed']
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }

    /**
     * Handle user registered events.
     */
    public function handleUserRegistered($event) {
        activity()->performedOn($event->user)
            ->withProperties([
                'user_agent'    => Request::userAgent(),
                'ip'            => Request::ip()
            ])
            ->useLog('registered')
            ->log('registered')
        ;
    }

    /**
     * Handle user verified events.
     */
    public function handleUserVerified($event) {
        activity()->performedOn($event->user)
            ->withProperties([
                'user_agent'    => Request::userAgent(),
                'ip'            => Request::ip()
            ])
            ->useLog('verified')
            ->log('verified')
        ;
    }

    /**
     * Handle user verified events.
     */
    public function handleUserPasswordReset($event) {
        activity()->performedOn($event->user)
            ->withProperties([
                'user_agent'    => Request::userAgent(),
                'ip'            => Request::ip()
            ])
            ->useLog('password reset')
            ->log('password reset')
        ;
    }

    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {
        activity()->performedOn($event->user)
            ->withProperties([
                'user_agent'    => Request::userAgent(),
                'ip'            => Request::ip()
            ])
            ->useLog('login')
            ->log('login')
        ;
    }

    /**
     * Handle user login failed events.
     */
    public function handleUserFailed($event) {
        //$event->credentials['password'] = Crypt::encryptString($event->credentials['password']);
        activity()->withProperties([
                'credentials'   => $event->credentials,
                'user_agent'    => Request::userAgent(),
                'ip'            => Request::ip()
            ])
            ->useLog('login failed')
            ->log('login failed')
        ;
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {
        activity()->performedOn($event->user)
            ->withProperties([
                'user_agent'    => Request::userAgent(),
                'ip'            => Request::ip()
            ])
            ->useLog('logout')
            ->log('logout')
        ;
    }
}
