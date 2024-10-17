<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\Report;
use App\Models\Review;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function approve(string $id)
    {
        // Find the report by its ID
        $report = Report::findOrFail($id);
        
        // Find the related review using the review_id from the report
        $review = Review::findOrFail($report->review_id);
    
        // Delete the review from the database
        $review->delete();
    
        // Mark the report as approved
        $report->status = 'approved';
        $report->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Review deleted and report approved successfully');
    }
    

    public function decline(string $id)
    {
        $report = Report::findOrFail($id);
        $review = Review::findOrFail($report->review_id);

        $review->status = 'declined';
        $review->save();

        $report->status = 'declined';
        $report->save();

        return redirect()->back()->with('success', 'Report declined successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $incomingFields = $request->validated();
        $incomingFields['status'] = 'pending';
        Report::create($incomingFields);

        return redirect()->back()->with('success', 'Report awaiting action from admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
