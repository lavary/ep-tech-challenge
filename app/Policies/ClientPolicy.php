<?php

namespace App\Policies;

use App\Client;
use App\User;

class ClientPolicy
{
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Client $client)
    {
        return $user->id === $client->user_id;
    }
}
