<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $authUser = Auth::user();

        if ($authUser) {
            $authUser->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phoneNumber'),
                'gender' => $request->input('gender'),
                'birthday' => $request->input('birthday'),
                'address' => $request->input('address'),
            ]);

            $authUser->candidate()->update([
                'description' => $request->input('description'),
            ]);
        }

        return $authUser->load([
            'candidate.education',
            'candidate.experiences',
            'staff',
        ]);
    }
}
