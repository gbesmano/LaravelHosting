<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FareController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Destination;
use App\Models\Fare;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login');
    });

    Route::get('/register', function () {
        return view('register');
    });

    Route::post('/register-account', [UserController::class, 'store']);
    Route::post('/login-account', [UserController::class, 'login']);

    Route::get('/destinations', function () {
        $destinations = Destination::where('status', 'approved')->get();

        return view('destinations', ['destinations' => $destinations]);
    });

    Route::get('/destination/view/{destination}', function (string $id) {
        $destination = Destination::findOrFail($id);
        $reviews = Review::where(['destination_id' => $destination->id, 'status' => 'pending'])->paginate(5);

        return view('destination_landing', ['title' => $destination->destination_name, 'destination' => $destination, 'reviews' => $reviews]);
    });

    Route::post('/review/store', [ReviewController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::middleware('super')->prefix('super')->group(function () {
        Route::get('dashboard', function () {
            $adminCount = User::where('type', 'admin')->count();
            $ownerCount = User::where('type', 'owner')->count();
            $destinationCount = Destination::where('status', 'approved')->count();
            $reviewCount = Review::count();

            return view('super/dashboard', [
                'title' => 'Dashboard',
                'adminCount' => $adminCount,
                'ownerCount' => $ownerCount,
                'destinationCount' => $destinationCount,
                'reviewCount' => $reviewCount,
            ]);
        });

        Route::get('admins/create', function () {
            return view('super/create_admin', ['title' => 'Add Admin']);
        });



        Route::get('admins', function () {
            $admins = User::where('type', 'admin')->paginate(50);
        
            // Convert created_at to Asia/Manila timezone for each admin and change the format
            foreach ($admins as $admin) {
                if ($admin->created_at instanceof \MongoDB\BSON\UTCDateTime) {
                    // Convert MongoDB\BSON\UTCDateTime to Carbon instance
                    $dateTime = $admin->created_at->toDateTime();
        
                    $admin->formatted_created_at = Carbon::parse($dateTime)
                        ->setTimezone('Asia/Manila')
                        ->format('F j, Y'); // Format as "Month, day, year" (e.g., October 11, 2024)
                }
            }
        
            return view('super/admins', ['title' => 'Admins', 'admins' => $admins]);
        });
        

        Route::post('admins/register', [UserController::class, 'store']);
        Route::put('admins/update/{id}', [UserController::class, 'update']);
        Route::delete('admins/delete/{user}', [UserController::class, 'destroy']);
        Route::get('admins/edit/{user}', function (string $id) {
            $admin = User::findOrFail($id);

            return view('super/edit_admin', ['title' => 'Edit Admin', 'admin' => $admin]);
        });
    });

    Route::middleware('owner')->prefix('owner')->group(function () {
        Route::get('dashboard', function () {
            return view('owner/dashboard', ['title' => 'Dashboard']);
        });


        Route::get('dashboard', function () {
            $reviewCount = Review::count();
            $destinationCount = Destination::where('status', 'approved')->count();
            $applicationCount = Destination::where('status', 'pending')->count();
            $declinedCount = Destination::where('status', 'declined')->count();
        
            // Get the currently authenticated user
            $user = Auth::user();
        
            return view('owner/dashboard', [
                'title' => 'Dashboard',
                'reviewCount' => $reviewCount,
                'applicationCount' => $applicationCount,
                'destinationCount' => $destinationCount,
                'declinedCount' => $declinedCount,
                'user' => $user, // Pass the user object to the view
            ]);
        });

        Route::get('applications/create', function () {
            return view('owner/create_destination', ['title' => 'Application']);
        });
        Route::post('destinations/store', [DestinationController::class, 'store'])->withoutMiddleware('owner');
        Route::get('applications', function () {
            $applications = Destination::whereIn('status', ['declined', 'pending'])
                ->where('user_id', auth()->user()->id)
                ->paginate(50);
        
            return view('owner/my_applications', ['title' => 'My Applications', 'applications' => $applications]);
        });
        
        Route::get('destinations', function () {
            $destinations = Destination::where('status', 'approved')
                ->where('user_id', auth()->user()->id)
                ->paginate(50);

            return view('owner/destinations', ['title' => 'Destinations', 'destinations' => $destinations]);
        });
        Route::delete('destinations/delete/{application}', [DestinationController::class, 'destroy']);
        Route::delete('applications/delete/{application}', [DestinationController::class, 'applicationdestroy']);
        Route::delete('applications/delete/{application}', [DestinationController::class, 'destinationdestroy']);
        Route::get('applications/view/{application}', [DestinationController::class, 'show']);
        Route::get('destination/presentation/{application}', [DestinationController::class, 'present']);
        Route::post('destination/coverphoto/{destination}', [DestinationController::class, 'coverphoto']);
        Route::get('applications/edit/{application}', [DestinationController::class, 'edit']);
        Route::put('applications/update/{destination}', [DestinationController::class, 'ownerupdate']);

        // Route::get('reviews', function () {
        //     $userId = auth()->user()->id;

        //     $reviews = Review::whereHas('destination', function ($query) use ($userId) {
        //         $query->where('user_id', $userId);
        //     })->where('status', '!=', 'declined')->paginate(50);

        //     return view('owner/reviews', ['title' => 'Reviews', 'reviews' => $reviews]);
        // });

        Route::get('reviews', [ReviewController::class, 'ownerindex']);

        // Route::get('reviews', function () {
        //     $reviews = Review::whereHas('destination', function ($query) {
        //             $query->where('user_id', auth()->user()->id);
        //         })
        //         ->paginate(50);
        
        //     return view('owner/reviews', ['title' => 'My Reviews', 'reviews' => $reviews]);
        // });
        

        Route::post('reports/store', [ReportController::class, 'store']);
    });

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            // Get the locality of the logged-in admin
            $adminLocality = auth()->user()->locality;
        
            // Fetch counts filtered by the admin's locality
            $reviewCount = Review::whereHas('destination', function($query) use ($adminLocality) {
                $query->where('locality', $adminLocality);
            })->count();
        
            $fareCount = Fare::count();

            $reportCount = Report::whereHas('review.destination', function($query) use ($adminLocality) {
                $query->where('locality', $adminLocality);
            })->count();
        
            $destinationCount = Destination::where('status', 'approved')
                                            ->where('locality', $adminLocality)
                                            ->count();
        
            $applicationCount = Destination::where('status', 'pending')
                                            ->where('locality', $adminLocality)
                                            ->count();
        
            $declinedCount = Destination::where('status', 'declined')
                                        ->where('locality', $adminLocality)
                                        ->count();
        
            // Get the currently authenticated user
            $user = Auth::user();
        
            // Return the view with the filtered data
            return view('admin/dashboard', [
                'title' => 'Dashboard',
                'reviewCount' => $reviewCount,
                'reportCount' => $reportCount,
                'fareCount' => $fareCount,
                'applicationCount' => $applicationCount,
                'destinationCount' => $destinationCount,
                'declinedCount' => $declinedCount,
                'user' => $user, // Pass the user object to the view
            ]);
        });
        

        Route::get('applications', function () {
            // Get the locality of the logged-in admin
            $adminLocality = auth()->user()->locality;
        
            // Fetch applications where the status is 'pending' and the locality matches the admin's locality
            $applications = Destination::with('user')
                                        ->where('status', 'pending')
                                        ->where('locality', $adminLocality) // Filter by admin's locality
                                        ->paginate(50);
        
            // Return the view with the filtered applications
            return view('admin/applications', [
                'title' => 'Applications',
                'applications' => $applications
            ]);
        });
        

        Route::get('applications/view/{application}', [DestinationController::class, 'showapplication']);
        Route::get('destinations/view/{destination}', [DestinationController::class, 'showdestination']);
        Route::delete('applications/delete/{application}', [DestinationController::class, 'viewdestroy']);
        Route::put('applications/approve/{application}', [DestinationController::class, 'approve']);
        Route::patch('applications/decline/{application}', [DestinationController::class, 'decline']);

        Route::delete('destinations/delete/{destination}', [DestinationController::class, 'destroy']);
        Route::get('destination/presentation/{destination}', [DestinationController::class, 'present']);
        Route::post('destination/coverphoto/{destination}', [DestinationController::class, 'coverphoto']);


        Route::get('reviews', [ReviewController::class, 'adminindex']);
        Route::delete('reviews/delete/{review}', [ReviewController::class, 'destroy']);
        Route::get('fares/create', function () {
            return view('admin/create_fare', ['title' => 'Create a Fare']);
        });

        Route::get('fares', function () {
            // Get the locality of the logged-in admin
            $adminLocality = auth()->user()->locality;
        
            // Fetch fares that belong to the admin's locality
            $fares = Fare::where('designated_locality', $adminLocality)->paginate(50);
        
            // Return the view with the filtered fares
            return view('admin/fares', [
                'title' => 'Fares',
                'fares' => $fares
            ]);
        });
        

        Route::post('fares/store', [FareController::class, 'store']);
        Route::get('fares/edit/{fare}', [FareController::class, 'show']);
        Route::delete('fares/delete/{fare}', [FareController::class, 'destroy']);
        Route::put('fares/update/{fare}', [FareController::class, 'update']);

        Route::get('destination/create', function () {
            return view('admin/create_destination', ['title' => 'Create a Destination']);
        });

        Route::get('destinations', [DestinationController::class, 'showApproved']);

        Route::get('destinations/edit/{application}', [DestinationController::class, 'edit']);
        Route::put('destinations/update/{destination}', [DestinationController::class, 'update']);
        
        


        Route::get('reports', function () {
            // Get the locality of the logged-in admin
            $adminLocality = auth()->user()->locality;
        
            // Fetch reports where the status is 'pending' and the review's destination belongs to the admin's locality
            $reports = Report::where('status', 'pending')
                        ->whereHas('review.destination', function($query) use ($adminLocality) {
                            $query->where('locality', $adminLocality); // Filter by admin's locality
                        })
                        ->with(['review', 'review.destination'])
                        ->paginate(50);
        
            // Convert created_at to Asia/Manila timezone for each report and change the format
            foreach ($reports as $report) {
                if ($report->created_at) {
                    $report->formatted_created_at = Carbon::parse($report->created_at)
                        ->setTimezone('Asia/Manila')
                        ->format('F j, Y'); // Format as "Month, day, year" (e.g., October 11, 2024)
                }
            }
        
            // Return the view with the filtered reports
            return view('admin/reports', [
                'title' => 'Reports',
                'reports' => $reports
            ]);
        });
        
        
        

        Route::patch('reports/approve/{report}', [ReportController::class, 'approve']);
        Route::patch('reports/decline/{report}', [ReportController::class, 'decline']);
    });
});
