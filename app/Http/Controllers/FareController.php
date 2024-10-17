<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFareRequest;
use App\Models\Fare;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFareRequest $request)
    {
        $incomingFields = $request->validated();
        Fare::create($incomingFields);

        return redirect()->back()->with('success', 'Fare added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fare = Fare::findOrFail($id);

        return view('admin/edit_fare', ['title' => 'Edit Fare', 'fare' => $fare]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFareRequest $request, string $id)
    {
        $incomingFields = $request->validated();
        $fare = Fare::findOrFail($id);
        $fare->update($incomingFields);

        return redirect('/admin/fares')->with('success', 'Fare updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fare = Fare::findOrFail($id);

        $fare->delete();

        return redirect()->back()->with('sucess', 'Fare deleted');
    }
}
