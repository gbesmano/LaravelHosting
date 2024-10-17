<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAccountRequest;
use App\Http\Requests\StoreAdminBusinessAcountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $types = [
        'super' => 'super/dashboard',
        'admin' => 'admin/dashboard',
        'customer' => 'customer/dashboard',
        'owner' => 'owner/dashboard',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function login(LoginAccountRequest $request)
    {
        $incomingFields = $request->validated();
    
        // Convert email to lowercase before attempting to authenticate
        if (isset($incomingFields['email'])) {
            $incomingFields['email'] = strtolower($incomingFields['email']);
        }
    
        if (Auth::attempt($incomingFields)) {
            $userType = Auth::user()->type;
    
            if (array_key_exists($userType, $this->types)) {
                return redirect($this->types[$userType]);
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminBusinessAcountRequest $request)
    {
        $incomingFields = $request->validated();
    
        // Convert the email to lowercase before storing it
        $incomingFields['email'] = strtolower($incomingFields['email']);
    
        // Capitalize the first letter of first name and last name before storing them
        if (isset($incomingFields['firstname'])) {
            $incomingFields['firstname'] = ucwords(strtolower($incomingFields['firstname']));
        }
    
        if (isset($incomingFields['lastname'])) {
            $incomingFields['lastname'] = ucwords(strtolower($incomingFields['lastname']));
        }
    
        User::create($incomingFields);
    
        return redirect()->back()->with('success', 'Account created successfully!');
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
    public function update(StoreAdminBusinessAcountRequest $request, string $id)
    {
        $incomingFields = $request->validated();

        $user = User::findOrFail($id);

        if (! empty($incomingFields['password'])) {
            $incomingFields['password'] = bcrypt($incomingFields['password']);
        } else {
            unset($incomingFields['password']);
        }

        $user->update($incomingFields);

        return redirect('/super/admins')->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/super/admins');
    }
}
