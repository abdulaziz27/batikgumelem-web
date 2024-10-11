<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class UpdateUserActivityInfo
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event)
    {
        $user = $event->user;
        $now = now();
        $user->update([
            'last_login_at' => $now,
            'last_login_ip' => $this->request->ip(),
            'login_count' => $user->login_count + 1,
            'last_activity_at' => $now,
        ]);
    }
}
