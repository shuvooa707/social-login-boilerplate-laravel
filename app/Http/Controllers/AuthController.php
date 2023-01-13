<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => [ "required", "email" ],
            "password" => [ "required", "string" ]
        ]);
        $yes = Auth::attempt($data);
        if( $yes ) 
        {
            return redirect()->route("profile");
        }
        
        return redirect()->back()->with("error", "Incorrect Credentials");
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "firstname" => ["required", "string"],
            "lastname" => ["required", "string"],
            "email" => ["required", "email"],
            "phone" => ["required"],
            "password" => ["required"],
        ]);
        $data["password"] = Hash::make($data["password"]);
        // dd($data);
        $user = User::create($data);
        if($user) 
        {
            $cred["email"] = $data["email"];
            $cred["password"] = $data["password"];
            Auth::attempt($cred);
            return redirect(routec("profile"));
        }

        return redirect()->back()->with("error", "something went wrong");
    }


    public function facebookCallback() 
    {
        $fbuser = Socialite::driver('facebook')->user();
        $email = $fbuser->email;
        $user = User::where("email", $email)->get()->first();
        if ( $user ) 
        {
            Auth::login($user);
            return redirect(routec("profile"));
        }
        else 
        {
            $name = explode(" ", $fbuser->name);
            $img =  Str::uuid() . ".jpg";
            file_put_contents("./img/" . $img, file_get_contents($fbuser->avatar_original));
            $user = User::create([
                "id" => $fbuser->id,
                "email" => $fbuser->email,
                "firstname" => $name[0],
                "lastname" => end($name),
                "img" => $img,
                "password" => Hash::make(Str::uuid())
            ]);
            if ( $user ) 
            {
                Auth::login($user);
                return redirect(routec("profile"));
            }
            return redirect(routec("login"));
        }
    }
    public function githubCallback() 
    {
        $gituser = (object)Socialite::driver('github')->user()->user;
        $email = $gituser->email;
        $user = User::where("email", $email)->get()->first();
        if ( $user ) 
        {
            Auth::login($user);
            return redirect(routec("profile"));
        }
        else 
        {
            $name = explode(" ", $gituser->name);
            $img =  Str::uuid() . ".jpg";
            file_put_contents("./img/" . $img, file_get_contents($gituser->avatar_url));
            $user = User::create([
                "id" => $gituser->id,
                "email" => $gituser->email,
                "firstname" => $name[0],
                "lastname" => end($name),
                "img" => $img,
                "password" => Hash::make(Str::uuid())
            ]);
            if ( $user ) 
            {
                Auth::login($user);
                return redirect(routec("profile"));
            }
            return redirect(routec("login"));
        }
    }

    public function googleCallback() 
    {
        $guser = (object)Socialite::driver('google')->user();
        $email = $guser->email;
        $user = User::where("email", $email)->get()->first();
        if ( $user ) 
        {
            Auth::login($user);
            return redirect(routec("profile"));
        }
        else 
        {
            $name = explode(" ", $guser->name);
            $img =  Str::uuid() . ".jpg";
            file_put_contents("./img/" . $img, file_get_contents($guser->avatar));
            $user = User::create([
                "email" => $guser->email,
                "firstname" => $name[0],
                "lastname" => end($name),
                "img" => $img,
                "password" => Hash::make(Str::uuid())
            ]);
            if ( $user ) 
            {
                Auth::login($user);
                return redirect(routec("profile"));
            }
            return redirect(routec("login"));
        }
    }


    public static function getUserToken(): string {
        // If we already have a user token, just return it
        // Tokens are valid for one hour, after that it needs to be refreshed
        if (isset(GraphHelper::$userToken)) {
            return GraphHelper::$userToken;
        }
    
        // https://learn.microsoft.com/azure/active-directory/develop/v2-oauth2-device-code
        $deviceCodeRequestUrl = 'https://login.microsoftonline.com/'.GraphHelper::$tenantId.'/oauth2/v2.0/devicecode';
        $tokenRequestUrl = 'https://login.microsoftonline.com/'.GraphHelper::$tenantId.'/oauth2/v2.0/token';
    
        // First POST to /devicecode
        $deviceCodeResponse = json_decode(GraphHelper::$tokenClient->post($deviceCodeRequestUrl, [
            'form_params' => [
                'client_id' => GraphHelper::$clientId,
                'scope' => GraphHelper::$graphUserScopes
            ]
        ])->getBody()->getContents());
    
        // Display the user prompt
        print($deviceCodeResponse->message.PHP_EOL);
    
        // Response also indicates how often to poll for completion
        // And gives a device code to send in the polling requests
        $interval = (int)$deviceCodeResponse->interval;
        $device_code = $deviceCodeResponse->device_code;
    
        // Do polling - if attempt times out the token endpoint
        // returns an error
        while (true) {
            sleep($interval);
    
            // POST to the /token endpoint
            $tokenResponse = GraphHelper::$tokenClient->post($tokenRequestUrl, [
                'form_params' => [
                    'client_id' => GraphHelper::$clientId,
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:device_code',
                    'device_code' => $device_code
                ],
                // These options are needed to enable getting
                // the response body from a 4xx response
                'http_errors' => false,
                'curl' => [
                    CURLOPT_FAILONERROR => false
                ]
            ]);
    
            if ($tokenResponse->getStatusCode() == 200) {
                // Return the access_token
                $responseBody = json_decode($tokenResponse->getBody()->getContents());
                GraphHelper::$userToken = $responseBody->access_token;
                return $responseBody->access_token;
            } else if ($tokenResponse->getStatusCode() == 400) {
                // Check the error in the response body
                $responseBody = json_decode($tokenResponse->getBody()->getContents());
                if (isset($responseBody->error)) {
                    $error = $responseBody->error;
                    // authorization_pending means we should keep polling
                    if (strcmp($error, 'authorization_pending') != 0) {
                        throw new Exception('Token endpoint returned '.$error, 100);
                    }
                }
            }
        }
    }

    public function microsoftCallback() 
    {
        $liveuser = (object)Socialite::driver('microsoft');
        dd($liveuser);
        $email = $liveuser->email;
        $user = User::where("email", $email)->get()->first();
        if ( $user ) 
        {
            Auth::login($user);
            return redirect(routec("profile"));
        }
        else 
        {
            $name = explode(" ", $liveuser->name);
            $img =  Str::uuid() . ".jpg";
            file_put_contents("./img/" . $img, file_get_contents($liveuser->avatar));
            $user = User::create([
                "email" => $liveuser->email,
                "firstname" => $name[0],
                "lastname" => end($name),
                "img" => $img,
                "password" => Hash::make(Str::uuid())
            ]);
            if ( $user ) 
            {
                Auth::login($user);
                return redirect(routec("profile"));
            }
            return redirect(routec("login"));
        }
    }
}
