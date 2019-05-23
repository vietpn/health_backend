<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserUpdateLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLogin $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        try{
            $id = $event->userId;
            $user = User::find($id)->update([
                'last_login' =>  date('Y-m-d H:i:s')
            ]);
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }
}
