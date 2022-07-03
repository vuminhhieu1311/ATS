<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebInitController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user()->load([
            'candidate.education',
            'candidate.experiences',
            'staff',
        ]);

        $user->permissionNames = $user->getAllPermissions()->pluck('name');
        $user->roleNames = $user->getRoleNames();

        return $user;
    }
}
