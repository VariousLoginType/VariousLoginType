<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse; 
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($driver){ 
        // driver names ['google','facebook','github','linkedIn','twitter']
        // driver names must be declared config/services.php
        return Socialite::driver($driver)->redirect();
    }

    // responsible to handle the Callback URL of Google,facebook... authentication
    public function callbackSocial($driver){
        // dd("bye");
        try{
            // dd("hello");
            // dd($driver);
            // To get the Google user detail
            $social_user = Socialite::driver($driver)->user(); 
            // To check if this Google user already exists in our database or not 
            $user = User::where('social_id', $social_user->getId())->first();
           
            if(!$user){ 
                $new_user = User::create([
                    'name' => $social_user->getName(),
                    'email' => $social_user->getEmail(),
                    'social_id' => $social_user->getId()
                ]);

                Auth::login($new_user);

            }else{
                Auth::login($user); 
            }
            return redirect()->intended('dashboard');
        }catch (Throwable $th){
            dd('Something went wrong! '. $th->getMessage());
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
