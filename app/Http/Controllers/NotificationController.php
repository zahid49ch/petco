<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class NotificationController extends Controller
{
    /**
     * Show the notification form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        $users = Reservation::all(); // Retrieve reservations
        return view('notifications', compact('users'));
    }

    /**
     * Handle the notification form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendNotification(Request $request)
{
    // Validate the request
    $request->validate([
        'message' => 'required|string',
        'owner' => 'required|exists:reservations,id',
    ]);

    $message = $request->input('message');
    $reservationId = $request->input('owner');

    // Find the reservation
    $reservation = Reservation::findOrFail($reservationId);

    try {
        // Send the email
        Mail::to($reservation->email)->send(new NotificationMail($message));
        // Set a success flash message
        $request->session()->flash('success', 'Notification sent successfully to ' . $reservation->email . '!');
    } catch (\Exception $e) {
        // Set an error flash message
        $request->session()->flash('error', 'Failed to send notification.');
    }

    // Redirect back to the form
    return redirect()->route('notification.form');
}

}
