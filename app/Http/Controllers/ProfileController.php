<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\EditProfilePasswordRequest;
use Budgeck\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the application profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Handles a profile save post request.
     *
     * @param \Budgeck\Http\Requests\EditProfileRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditProfileRequest $request)
    {
        $this->user->fill($request->all());
        $this->user->save();

        return response()->json([
            'success' => 'Vos informations ont été mise à jour.',
        ]);
    }

    /**
     * Handles a password save post request.
     *
     * @param \Budgeck\Http\Requests\EditProfilePasswordRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(EditProfilePasswordRequest $request)
    {
        // Check if old password matches current password
        if (!Hash::check($request->get('oldpassword'), $this->user->password)) {
            return response()->json([
                'form' => 'L\'ancien mot de passe est incorrect.',
            ], 422);
        }

        // Change password
        $this->user->password = Hash::make($request->get('newpassword'));
        $this->user->save();

        return response()->json([
            'success' => 'Votre mot de passe a été mise à jour.',
        ]);
    }
}
