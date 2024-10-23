<?php

namespace App\Policies;

use App\Booking;
use App\User;

class BookingPolicy
{
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Booking  $booking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Booking $booking)
    {
        return $user->id === $booking->client->user_id;
    }
}
