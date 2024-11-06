<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spend;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade as PDF;

class SpendsReportController extends Controller
{

    public function showCreateForm()
{
    return view('create-spend');
}
    // Method to display the form
    public function showForm()
    {
        return view('spends-report');
    }

    // Method to handle form submission and show the report
    public function generateReport(Request $request)
    {
        // Validate the request data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Fetch spends within the specified date range
        $spends = Spend::whereBetween('check_in_date', [$request->input('start_date'), $request->input('end_date')])
                       ->get();

        // Calculate total amount
        $totalAmount = $spends->sum('amount');

        // Pass data to the view
        return view('spends-report', [
            'spends' => $spends,
            'totalAmount' => $totalAmount,
        ]);
    }

    // Method to handle record storage
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'check_in_date' => 'required|date',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // Create a new spend record
        Spend::create([
            'check_in_date' => $request->input('check_in_date'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
        ]);

        // Redirect back with success message
        return redirect()->route('spends-report.form')->with('success', 'Spend record saved successfully!');
    }
    public function exportCSV(Request $request)
{
    // Validate the request data
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Fetch spends within the specified date range
    $spends = Spend::whereBetween('check_in_date', [$request->input('start_date'), $request->input('end_date')])
                   ->get();

    $handle = fopen('php://output', 'w');
    fputcsv($handle, ['Date', 'Description', 'Amount']);

    foreach ($spends as $spend) {
        fputcsv($handle, [
            $spend->check_in_date,
            $spend->description,
            number_format($spend->amount, 2),
        ]);
    }

    fclose($handle);

    return response()->stream(
        function () use ($handle) {
            fclose($handle);
        },
        200,
        [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="spends-report.csv"',
        ]
    );
}
public function exportPDF(Request $request)
{
    // Validate the request data
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Fetch spends within the specified date range
    $spends = Spend::whereBetween('check_in_date', [$request->input('start_date'), $request->input('end_date')])
                   ->get();

    $totalAmount = $spends->sum('amount');

    $pdf = PDF::loadView('spends-report-pdf', [
        'spends' => $spends,
        'totalAmount' => $totalAmount,
    ]);

    return $pdf->download('spends-report.pdf');
}
}

