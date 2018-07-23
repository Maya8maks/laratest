<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Storage;
use App\SocialFacebookAccount;
use App\User;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallbackFromFacebook(Request $request)
    {
        $input = $request->except('_token');
//        $account = User::whereProvider('facebook');

//        $user = Socialite::driver('facebook')->user();

        dd($input);
    }

    /**
     * Redirect the user to the Github authentication page.
     *
     * @return Response
     */
    public function redirectToGithubProvider()
    {
        return Socialite::driver('github')->redirect();
    }
    /**
     * Obtain the user information from Github.
     *
     * @return Response
     */
    public function handleProviderCallbackFromGithub()
    {
        $user = Socialite::driver('github')->user();
        if($user->email == null){
            return redirect()->route('loginUser')->withErrors(['social'=>"Your GitHub Haven't email. Sorry login with email"]);
        }
        $client = Client::where('email', $user['email'])->first();
        if(empty($client['email'])){
            $data=[
                'email' => $user['email'],
                'name' => $user['name'],
                'nickname'=>$user['login']
            ];
            $client = new Client();
            $client->fill($data)->save();
            $data = [
                'user' => $client
            ];
            return view('auth.test', $data);
        }else{
            if($user['name']!= null){$name = $user['name'];}else{$name = $client->name;}
            if($user['login'] != null){$nickname = $user['login'];}else{$nickname = $client->nickname;}
            $update=[
                'name' => $name,
                'nickname'=>$nickname
            ];
            $client->fill($update)->update();
            $data = [
                'user' => $client,
            ];
            return view('auth.test', $data);
        }
        return view('index');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallbackFromGoogle()
    {
        $user = Socialite::driver('google')->user();
        if($user->email == null){
            return redirect()->route('loginUser')->withErrors(['social'=>"Your Gooogle+ Haven't email. Sorry login with email"]);
        }
        $client = Client::where('email', $user->email)->first();
        if(empty($client['email'])){
            $data=[
                'email' => $user->email,
                'name' => $user['name']['givenName'],
                'lastname' => $user['name']['familyName'],
                'nickname' => $user->nickname
            ];
            $client = new Client();
            $client->fill($data)->save();
            $data = [
                'user' => $client
            ];
            return view('auth.test', $data);
        }else{
            if($user['name']['givenName'] != null){$name = $user['name']['givenName'];}else{$name = $client->name;}
            if($user['name']['familyName'] != null){$lastname = $user['name']['familyName'];}else{$lastname = $client->lastname;}
            if($user->nickname != null){$nickname = $user->nickname;}else{$nickname = $client->nickname;}
            $update=[
                'name' => $name,
                'lastname' => $lastname,
                'nickname' => $nickname
            ];
            $client->fill($update)->update();
            $data = [
                'user' => $client,
            ];
            return view('auth.test', $data);
        }
        return view('index');
    }

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
     */
    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }
    /**
     * Obtain the user information from Twitter.
     *
     * @return Response
     */
    public function handleProviderCallbackFromTwitter()
    {
        $user = Socialite::driver('twitter')->user();
        if($user->email == null){
            return redirect()->route('loginUser')->withErrors(['social'=>"Your Twitter Haven't email. Sorry login with email"]);
        }
        $client = Client::where('email', $user->email)->first();
        if(empty($client['email'])){
            $data=[
                'email' => $user->email,
                'name' => $user->name,
                'nickname' => $user->nickname
            ];
            $client = new Client();
            $client->fill($data)->save();
            $data = [
                'user' => $client
            ];
            return view('auth.test', $data);
        }else {
            if($user->name != null){$name = $user->name;}else{$name = $client->name;}
            if($user->nickname != null){$nickname = $user->nickname;}else{$nickname = $client->nickname;}
            $update = [
                'name' => $name,
                'nickname' => $nickname
            ];
            $client->fill($update)->update();
            $data = [
                'user' => $client,
            ];
            return view('auth.test', $data);
        }
    }
    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return Response
     */
    public function redirectToLinkedinProvider()
    {
        return Socialite::with('linkedin')->redirect();
    }
    /**
     * Obtain the user information from Linkedin.
     *
     * @return Response
     */
    public function handleProviderCallbackFromLinkedin()
    {
        $user = Socialite::driver('linkedin')->user();
        if($user->email == null){
            return redirect()->route('loginUser')->withErrors(['social'=>"Your Twitter Haven't email. Sorry login with email"]);
        }
        $client = Client::where('email', $user->email)->first();
        if(empty($client['email'])){
            $data=[
                'email' => $user->email,
                'name' => $user['lastName'],
                'lastname' => $user['firstName'],
                'nickname' => $user->nickname
            ];
            $client = new Client();
            $client->fill($data)->save();
            $data = [
                'user' => $client
            ];
            return view('auth.test', $data);
        }else {
            if($user['firstName'] != null){$lastname = $user['firstName'];}else{$lastname = $client->lastname;}
            if($user['lastName'] != null){$name = $user['lastName'];}else{$name = $client->name;}
            if($user->nickname != null){$nickname = $user->nickname;}else{$nickname = $client->nickname;}
            $update = [
                'name' => $name,
                'lastname' => $lastname,
                'nickname' => $nickname
            ];
            $client->fill($update)->update();
            $data = [
                'user' => $client,
            ];
            return view('auth.test', $data);
        }
    }
    public function registerForm()
    {
       return view('pagesRegister');
    }
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = [
                'name' => $request['name'],
                'lastname' => $request['lastName'],
                'user_name' => $request['user_name'],
                'country' => $request['country'],
                'profession' => $request['profession'],
                'password' => Hash::make($request['password']),
                'role' => 'doctor',
            ];
            $doctor = new User();
            $doctor->fill($data)->save();

            if (Input::hasFile('image')) {
                if (Input::file('image')->isValid()) {
                    $file = Input::file('image');
                    $ext = $file->guessClientExtension();
                    $name = 'doctor.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], 'files/doctors/' .$doctor->id. $name);
                }
            }
                return redirect('/loginUser');}
    else {
        return redirect()->back();
    }
    }

}
