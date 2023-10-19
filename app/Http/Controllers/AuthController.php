<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // primește id-ul și poșta utilizatorului

        $code = Str::random(10);

        // trimite codul pe email

        $loginAttempt = new LoginAttempt();
        $loginAttempt->user_id = 5; // de utilizat id real
        $loginAttempt->code = $code;
        $loginAttempt->save();

        return response()->json(['login_attempt_id' => $loginAttempt->id]);
    }
    
    public function verifyCode(Request $request)
    {
        $loginAttemptId = $request->input('loginAttemptId');
        $code = $request->input('code');

        $loginAttempt = LoginAttempt::find($loginAttemptId);


        if (!$loginAttempt || $loginAttempt->code !== $code) {
            return response()->json(['message' => 'Code verification failed', 'code' => $request->input('code')], 401);
        }

        $loginAttempt->delete();
        // logica de logare finală

        return response()->json(['message' => 'Code verified successfully']);
    }
}