<?php

namespace App\Subscribers\Models;

use App\Events\Models\User\userCreated;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class UserSubscriber {

    public function subscribe(Dispatcher $events){
        $events->listen( userCreated::class, SendWelcomeEmail::class);
    }
}
