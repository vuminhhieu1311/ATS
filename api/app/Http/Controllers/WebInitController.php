<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebInitController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->load('candidate.education', 'staff');
    }
}
