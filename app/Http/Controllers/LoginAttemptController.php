<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class LoginAttemptController extends Controller
{
    public function create(Request $request) {
        
        $loginAttempt = new LoginAttempt();

        $loginAttempt->user_id = auth()->user()->id;

        $loginAttempt->code = Str::random(10);

        $loginAttempt->save();

        return response()->json(['attemptId' => $loginAttempt->id]);
    }
}
