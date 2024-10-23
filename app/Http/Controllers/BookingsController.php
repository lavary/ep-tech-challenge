<?php

namespace App\Http\Controllers;

use App\Booking;

class BookingsController extends Controller
{
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return 'Deleted';
    }
}
