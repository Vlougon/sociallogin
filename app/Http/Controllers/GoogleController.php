<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function socialLogin()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::UpdateOrCreate(
            ['github_id' => $googleUser->id],
            [
                'name' => $googleUser->name ? $googleUser->name : 'Anon Google',
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
