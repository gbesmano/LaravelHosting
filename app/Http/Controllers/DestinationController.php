<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationRequest;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DestinationController extends Controller
{
    /**
     * The file fields for uploading.
     *
     * @var array
     */
    protected $fileFields = [
        'company_permit',
        'location_clearance',
        'barangay_clearance',
        'philhealth',
        'corporate_bank_account',
        'sec_registration',
        'tin',
        'sss',
    ];

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request)
    {
        $request->validate([
            'locality' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:20'],
        ]);

        $incomingFields = $request->validated();
        $fileNames = [];

        foreach ($this->fileFields as $field) {
            if ($request->hasFile($field)) {
                $fileNames[$field] = $this->handleFileUpload($request->file($field), $field);
            }
        }

        $incomingFields = array_merge($incomingFields, $fileNames);
        Destination::create($incomingFields);

        return redirect()->back()->with('success', 'Destination added successfully!');
    }

    /**
     * Handle file upload and return the new file name.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder
     * @return string
     */
    protected function handleFileUpload($file, $folder)
    {
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/'.$folder), $fileName);

        return $fileName;
    }

    /**
     * Display the specified resource.
     */


    public function show(string $id)
    {

        $application = Destination::findOrFail($id);

        return view("owner/view_destination", ['title' => $application->destination_name, 'application' => $application]);
    }

    public function showdestination(string $id)
    {
        $application = Destination::findOrFail($id);

        return view("admin/view_destination", ['title' => $application->destination_name, 'application' => $application]);
    }

    public function showapplication(string $id)
    {
        $application = Destination::findOrFail($id);

        return view("admin/view_application", ['title' => $application->destination_name, 'application' => $application]);
    }
    
    public function edit(string $id)
    {
        $folder = auth()->user()->type === 'admin' ? 'admin' : 'owner';
        $application = Destination::findOrFail($id);

        return view("$folder/edit_destination", ['title' => $application->destination_name, 'application' => $application]);
    }
    

    public function present(string $id)
    {
        $folder = auth()->user()->type === 'admin' ? 'admin' : 'owner';
        $destination = Destination::findOrFail($id);

        return view("$folder/destination_landing", ['title' => $destination->destination_name, 'destination' => $destination]);
    }
    
    public function showApproved()
    {
        // Get the locality of the logged-in admin
        $adminLocality = auth()->user()->locality;
    
        // Fetch only approved destinations that belong to the admin's locality
        $destinations = Destination::where('status', 'approved')
                                    ->where('locality', $adminLocality)
                                    ->paginate(50);
    
        // Return the view with the filtered destinations
        return view('admin/admin_destinations', [
            'title' => 'Destinations',
            'destinations' => $destinations
        ]);
    }
    
    public function coverphoto(Request $request, string $id)
    {
        $destination = Destination::findOrFail($id);
        $oldFile = 'images/coverphotos/'.$destination->coverphoto;
        $fileName = '';

        if ($request->hasFile('coverphoto')) {
            $fileName = $this->handleFileUpload($request->file('coverphoto'), 'coverphotos');
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
        }

        $destination->coverphoto = $fileName;
        $destination->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDestinationRequest $request, string $id)
    {
        $incomingFields = $request->validated();
        $fileNames = [];

        foreach ($this->fileFields as $field) {
            if ($request->hasFile($field)) {
                $fileNames[$field] = $this->handleFileUpload($request->file($field), $field);
            }
        }

        $destination = Destination::findOrFail($id);
        $incomingFields = array_merge($incomingFields, $fileNames);
        $destination->update($incomingFields);

        return redirect('/admin/destinations')->with('success', 'Destination updated successfully');
    }

    public function ownerupdate(StoreDestinationRequest $request, string $id)
    {
        $incomingFields = $request->validated();
        $fileNames = [];

        foreach ($this->fileFields as $field) {
            if ($request->hasFile($field)) {
                $fileNames[$field] = $this->handleFileUpload($request->file($field), $field);
            }
        }

        $destination = Destination::findOrFail($id);
        $incomingFields = array_merge($incomingFields, $fileNames);
        $destination->update($incomingFields);

        return redirect('/owner/destinations')->with('success', 'Destination updated successfully');
    }
    public function approve(string $id)
    {
        $application = Destination::findOrFail($id);
        $application->status = 'approved';
        $application->save();

        return redirect('/admin/applications')->with('success', 'Application approved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination = Destination::findOrFail($id);

        foreach ($this->fileFields as $field) {
            if ($destination->$field) {
                $filePath = public_path('images/'.$field.'/'.$destination->$field);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
        }

        $destination->delete();

        return redirect()->back()->with('success', 'Destination deleted successfully!');
    }

    public function viewdestroy(string $id)
    {
        $destination = Destination::findOrFail($id);

        foreach ($this->fileFields as $field) {
            if ($destination->$field) {
                $filePath = public_path('images/'.$field.'/'.$destination->$field);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
        }

        $destination->delete();

        return redirect('/admin/applications')->with('success', 'Application deleted successfully!');
    }
    


    public function applicationdestroy(string $id)
    {
        $destination = Destination::findOrFail($id);


        $destination->delete();

        return redirect('/owner/applications')->with('success', 'Application deleted successfully!');
    }
    
    public function destinationdestroy(string $id)
    {
        $destination = Destination::findOrFail($id);


        $destination->delete();

        return redirect('/owner/destinations')->with('success', 'Destination deleted successfully!');
    }

    public function decline(string $id)
    {
        $application = Destination::findOrFail($id);
        $application->status = 'declined';
        $application->save();
    
        return redirect('/admin/applications')->with('success', 'Application rejected successfully!');
    }
    


}
