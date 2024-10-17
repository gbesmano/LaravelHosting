<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Facades\Log; // Import Log for logging
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ownerindex(Request $request)
    {
        $userId = $request->user()->id;
    
        $reviews = Review::whereHas('destination', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->whereIn('status', ['pending', 'approved', 'declined'])->paginate(50);
    
        // Convert createdAt to Asia/Manila timezone for each review and change the format
        foreach ($reviews as $review) {
            if ($review->createdAt instanceof \MongoDB\BSON\UTCDateTime) {
                // Convert MongoDB\BSON\UTCDateTime to Carbon instance
                $dateTime = $review->createdAt->toDateTime();
                
                $review->formatted_created_at = Carbon::parse($dateTime)
                    ->setTimezone('Asia/Manila')
                    ->format('F j, Y'); // Format as "Month, day, year" (e.g., October 11, 2024)
            }
        }
    
        return view('owner/reviews', ['title' => 'Reviews', 'reviews' => $reviews]);
    }
    
    
    

    public function adminindex(Request $request)
    {
        // Get the locality of the logged-in admin
        $adminLocality = $request->user()->locality;
        $userId = $request->user()->id;
    
        // Fetch reviews where the related destination belongs to the admin's locality and the destination's user_id matches
        $reviews = Review::whereHas('destination', function ($query) use ($userId, $adminLocality) {
            $query->where('user_id', $userId)
                  ->where('locality', $adminLocality); // Ensure locality matches the admin's locality
        })->where('status', '!=', 'declined')->paginate(50);
    
        // Convert createdAt to Asia/Manila timezone for each review and change the format
        foreach ($reviews as $review) {
            if ($review->createdAt instanceof \MongoDB\BSON\UTCDateTime) {
                // Convert MongoDB\BSON\UTCDateTime to Carbon instance
                $dateTime = $review->createdAt->toDateTime();
    
                $review->formatted_created_at = Carbon::parse($dateTime)
                    ->setTimezone('Asia/Manila')
                    ->format('F j, Y'); // Format as "Month, day, year" (e.g., October 11, 2024)
            }
        }
    
        // Return the view with the filtered reviews
        return view('admin/reviews', [
            'title' => 'Reviews',
            'reviews' => $reviews
        ]);
    }
    
    
    


    /**
     * Store a newly created resource in storage.
     */
        
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_title' => 'required|string|max:255',
            'comment' => 'required|string',
            'date' => 'required|date',
            'proof' => 'required|string',
            'destination_id' => 'required|exists:destinations,_id',
            'user_id' => 'required|exists:client_users,_id',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        Review::create($request->all());

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $application = Destination::findOrFail($id);

       return view('owner/reviews', ['title' => 'Reviews', 'reviews' => $reviews]);
    
     
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
        // Find the review by ID or fail with a 404 error if not found
        $review = Review::findOrFail($id);
    
        // Delete the review
        $review->delete();
    
        // Redirect back to the reviews page with a success message
        return redirect('/admin/reviews')->with('success', 'Review deleted successfully!');
    }
    
    
}
