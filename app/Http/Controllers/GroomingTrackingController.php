<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\GroomingTracking;

class GroomingTrackingController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:dogs,id', // Validate owner_id against dogs table
            'step' => 'required|in:Step1,Step2,Step3,Step4',
        ]);

        GroomingTracking::updateOrCreate(
            ['owner_id' => $request->owner_id],
            ['step' => $request->step]
        );

        return redirect()->back()->with('success', 'Grooming Tracking updated successfully.');
    }

    public function showUpdateForm()
    {
        $dogs = Dog::all(); // Fetch all dogs for the owner_id dropdown
        return view('grooming-tracking', compact('dogs'));
    }
}
