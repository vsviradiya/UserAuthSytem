<?php

namespace App\Observers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;

use App\Mail\Subscribe;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        // $this->sendMailable($user, Subscribe::class);
        dd($user ,"vvv");
        $details = [
            'title' => 'Mail from logisticli15',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to('vaibhavviradiya123.vv@gmail.com')->send(new \App\Mail\Subscribe($details));
        
        // Log::info(["detail" => $details]);
        // $del_user = User::find($id);

        // $details = [
        //     'title' => 'Mail from logisticli15',
        //     'body' => 'user is deleted'
        // ];
        // dd($user);

    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
