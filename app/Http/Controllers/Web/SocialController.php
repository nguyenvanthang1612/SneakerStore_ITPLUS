<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect('/');
            }else{
                $createUser = User::create([
                    'role' => 3,
                    'user_name' => $user->name,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123'),
                    'first_name' => null,
                    'last_name' => null,
                    'email' => null,
                    'telephone' => null
                ]);
                
                // $createUserAddress = UserAddress::create([
                //     'address' => $user->address,
                //     'city' => $user->address,
                //     'country' => $user->country
                // ]);
                Auth::login($createUser);
                return redirect('/');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
       

    public function gitCallback()
    {
        try {
     
            $gitUser = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $gitUser->id)->first();
      
            if($searchUser){
      
                Auth::login($searchUser);
     
                return redirect('/');
      
            }else{
                $createUser = User::create([
                    'role' => 3,
                    'user_name' => $gitUser->nickname,
                    'email' => $gitUser->email,
                    'github_id'=> $gitUser->id,
                    'auth_type'=> 'github',
                    'password' => encrypt('git123'),
                    'first_name' => $gitUser->nickname,
                    'last_name' => $gitUser->nickname,
                    'telephone' => null
                ]);
     
                Auth::login($createUser);
      
                return redirect('/');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
