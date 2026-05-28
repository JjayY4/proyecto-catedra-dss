<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user()->load('passenger');
        
        return view('profile.profile', [
            'user' => $request->user(),
        ]);
    }
}