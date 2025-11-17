<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Profile';
        $user = Auth::user();
        $userDetail = Auth::user()->userDetail;
        return view('profile.index', compact('title', 'user', 'userDetail'));
    }

    public function changePassword(Request $request)
    {
        // return $request;
        $request->validate = ([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            alert()->error('Faill', 'The old password is wrong');
            return back();
        }
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        alert()->success('Suscces', 'Change Password secucces');
        return back();
    }

    public function changeProfiles(Request $request)
    {
        $user = Auth::user();
        $photopath = '';
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            if ($user->userDetail && $user->userDetail->photo) {
                File::delete(public_path('storage/' . $user->userDetail->photo));
            }
            $photopath = $photo->store('profile', 'public');
        }
        try {
            UserDetail::upsert(
                [
                    [
                        'user_id' => $user->id,
                        'about' => $request->about,
                        'company' => $request->company,
                        'phone' => $request->phone,
                        'job' => $request->job,
                        'address' => $request->address,
                        'photo' => $photopath ?? ($user->userDetail->photo ?? ''),
                    ],
                ],
                ['user_id'],
                ['phone', 'about', 'address', 'company', 'job', 'photo']
            );
            alert()->success('success', 'Edit Profile success');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
