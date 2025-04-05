<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $user->id = (string) Str::uuid();
        $this->hashPassword($user);
    }

    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user): void
    {
        // if ($user->isDirty('password')) {
        //     $this->hashPassword($user);
        // }
    }

    protected function hashPassword(User $user): void
    {
        if ($user->password) {
            $user->password = Hash::make($user->password);
        }
    }
}
