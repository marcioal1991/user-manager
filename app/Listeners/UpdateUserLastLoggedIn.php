<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

readonly class UpdateUserLastLoggedIn
{
    public function __construct(protected Login $event)
    {

    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        $user->last_logged_in = Carbon::now();
        $user->save();
    }
}
