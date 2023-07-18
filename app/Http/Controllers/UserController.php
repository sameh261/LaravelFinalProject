<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\User;
use App\Models\UserDetail;

class UserController extends Controller
{
    public function getProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userDetail = $user->userDetails()->first();

            return response()->json([
                'data' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $userDetail->phone ?? '',
                    'address' => $userDetail->address ?? '',
                    'city' => $userDetail->city ?? '',
                    'state' => $userDetail->state ?? '',
                    'zip' => $userDetail->zip ?? '',
                    'country' => $userDetail->country ?? '',
                    'avatar' => $user->avatar ?? '',
                ]
            ]);
        } else {
            return response()->json([
                'error' => 'User not authenticated',
            ], 401);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $userDetail = $user->userDetails()->first();

        $user->fill($request->only([
            'first_name',
            'last_name',
            'email',
        ]));

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('uploads/avatars/' . $filename);
            Image::make($avatar)->save($path);
            $user->avatar = $filename;
        }



        if ($userDetail) {
            $userDetail->fill($request->only([
                'phone',
                'address',
                'city',
                'state',
                'zip',
                'country',
            ]));
        } else {
            $userDetail = new UserDetail($request->only([
                'phone',
                'address',
                'city',
                'state',
                'zip',
                'country',
            ]));
            $user->userDetails()->save($userDetail);
        }

        $user->save();
        $userDetail->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
        ]);
    }


    public function index()
    {
        $users = User::all();

        return view('admin', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'role_id' => $request->role_id
        ]);

        return back();
    }
}
