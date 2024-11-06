<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;


class HotelLogReportController extends Controller
{
    public function showForm(Request $request)
    {
        // Define the default dates if not provided
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Fetch bookings within the date range
        $bookings = Booking::whereBetween('start_date', [$startDate, $endDate])->get();

        // Calculate total revenue
        $totalRevenue = $bookings->sum('amount'); // Assuming you have a 'price' field in your bookings table

        return view('hotel_log_report', compact('bookings', 'totalRevenue', 'startDate', 'endDate'));
    }



    // public function showForm()
    // {
    //     // Fetch all bookings, or apply necessary filters
    //     $bookings = Booking::all(); // Adjust this line as necessary for your use case

    //     return view('hotel_log_report', compact('bookings'));
    // }

    public function handleForm(Request $request)
    {
        // Validate and process the form input
        $request->validate([
            'date_from' => 'required|date',
            'date_to' => 'required|date',
        ]);

        // Logic to process the date range and fetch report data

        // Example: return the view with report data
        return view('hotel_log_report', [
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            // Include report data here
        ]);
    }
}

