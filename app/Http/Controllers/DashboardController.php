<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Spend;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            // Fetch total number of clients
            $clientCount = Reservation::count();

            // Fetch total spends amount
            $totalSpends = Spend::sum('amount'); // Assuming 'amount' is the column for spends

            // Fetch total hotel revenue amount
            $hotelRevenue = Booking::sum('amount'); // Assuming 'amount' is the column for revenue

            return view('dashboard', [
                'user' => Auth::user(),
                'welcomeMessage' => 'Welcome to the Petco App Dashboard!',
                'clientCount' => $clientCount,
                'totalSpends' => number_format($totalSpends, 2), // Format as currency
                'hotelRevenue' => number_format($hotelRevenue, 2), // Format as currency
            ]);
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ]);
    }
}


