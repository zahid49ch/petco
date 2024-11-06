<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class CheckInCheckOutController extends Controller
{
    // Show the form with booking details
    public function showForm($id)
    {
        // Fetch the reservation by ID
        $reservation = Reservation::findOrFail($id);

        return view('checkin_checkout_form', compact('reservation'));
    }

    // Handle the form submission
    public function submitForm(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'indate' => 'required|date',
            'outdate' => 'required|date',
            'status' => 'required|in:confirmed,notconfirmed',
        ]);

        // Find the reservation and update it
        $reservation = Reservation::findOrFail($id);
        $reservation->indate = $validated['indate'];
        $reservation->outdate = $validated['outdate'];
        $reservation->status = $validated['status'];
        $reservation->save();

        // Redirect back with a success message
        return redirect()->route('update-confirmation.index')->with('success', 'Booking updated successfully!');
    }
}

