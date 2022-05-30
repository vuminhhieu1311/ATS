<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateAvatarController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $filePath = $request->file('img')->store('public/avatars');
        $user->update([
            'profile_photo_url' => Storage::url($filePath),
        ]);

        return $user->load([
            'candidate.education',
            'candidate.experiences',
            'staff',
        ]);
    }
}
