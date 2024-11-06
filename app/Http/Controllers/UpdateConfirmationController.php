<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class UpdateConfirmationController extends Controller
{
    /**
     * Show the list of check-ins and check-outs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all reservations from the database
        $reservations = Reservation::all();

        // Pass the reservations variable to the view
        return view('update_confirmation', compact('reservations'));
    }

    /**
     * Handle the status update.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|string|in:confirmed,notconfirmed',
        ]);

        // Find the reservation and update the status
        $reservation = Reservation::findOrFail($id);

        $reservation->indate = $request->input('indate');
        $reservation->outdate = $request->input('outdate');
        $reservation->status = $request->input('status');
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully');
        // Redirect with success message
        // return redirect()->route('update-confirmation.index')->with('success', 'Status updated successfully!');
    }
}
