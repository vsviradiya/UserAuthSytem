<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user){
        info('creating called');
        
        function unique_code($limit)
        {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        }
        $user->unique_id = unique_code(6);

        // $user->unique_id = (string) Uuid::generate(6);

        // $user->unique_id = mt_rand(100000, 999999);
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    
    public function created(User $user)
    {
        
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
        info('deleted called');
        // \Log::info("User " . $user->id);
        $details = [
            'title' => 'Mail from logisticli15',
            'body' => 'This is for testing email using smtp'
        ];
      
        Mail::to('vaibhavviradiya123.vv@gmail.com')->send(new \App\Mail\Subscribe($details));
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
