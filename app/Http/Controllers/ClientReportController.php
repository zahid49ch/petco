<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade as PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ClientReportController extends Controller
{
    public function showForm()
    {
        return view('client-report');
    }

    public function submitReport(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $reportData = Dog::whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')])
                         ->get();

        return view('client-report', [
            'date_from' => $request->input('start_date'),
            'date_to' => $request->input('end_date'),
            'reportData' => $reportData
        ]);
    }

    public function getClients()
    {
        $clients = Dog::all();

        return response([
            'status' => 'true',
            'data' => $clients,
        ]);
    }

    public function exportCSV(Request $request)
{
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    $reportData = Dog::whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')])
                     ->get();

    $handle = fopen('php://output', 'w');
    fputcsv($handle, ['ID', 'Owner', 'Email', 'Pet', 'Pet Details']);

    foreach ($reportData as $record) {
        fputcsv($handle, [
            $record->id,
            $record->ownername,
            $record->email,
            $record->dogname,
            $record->dogdetail,
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
            'Content-Disposition' => 'attachment; filename="report.csv"',
        ]
    );
}

public function exportPDF(Request $request)
{
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    $reportData = Dog::whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')])
                     ->get();

    // Debugging: Check data
    // dd($reportData->ToArray());

    $pdf = \PDF::loadView('pdf.report', [
        'reportData' => $reportData,
        'date_from' => $request->input('start_date'),
        'date_to' => $request->input('end_date')
    ]);

    return $pdf->download('report_' . date('Y-m-d') . '.pdf');
}

}

