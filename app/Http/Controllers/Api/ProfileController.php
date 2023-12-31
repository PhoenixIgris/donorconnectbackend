<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    public function store(Request $request)
    {
        //validate
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'notification_preference' => 'nullable|string|max:255',
        ]);

        $profile = Profile::create($validatedData);
        return response()->json($profile,201); 
    }

    public function show(Profile $profile)
    {
        return response()->json($profile);
    }

    public function update(Request $request, Profile $profile)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'notification_preference' => 'nullable|string|max:255',
        ]);

        $profile->update($validatedData);
        return response()->json($profile,200);
    
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(['message'=> 'Profile Deleted Succesfully!!'],200);
    }
}
