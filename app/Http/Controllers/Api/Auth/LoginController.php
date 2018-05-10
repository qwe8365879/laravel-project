<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use App\Exceptions\FailedInternalRequestException;

class LoginController extends Controller
{
    private $app;

    public function __construct(Application $app){
        $this->app = $app;
    }

    public function login(\App\Http\Requests\Api\Auth\Login $request){
        $data = [
            'username' => $request->email,
            'password' => $request->password
        ];
        return $this->proxy('password', $data);
    }

    public function refresh(Request $request){
        $data = [
            'refresh_token' => $request->input('refresh_token')
        ];
        return $this->proxy('refresh_token', $data);
    }

    private function proxy($grantType, array $data = []){
        $data = array_merge($data, [
            'client_id'     => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type'    => $grantType
        ]);

        // Create request
        $request = Request::create('/oauth/token', 'POST', $data, [], [], [
            'HTTP_Accept'             => 'application/json',
        ]);
        // Get response
        $response = $this->app->handle($request);
        if ($response->getStatusCode() >= 400) {
            throw new FailedInternalRequestException($request, $response);
        }
        // Dispatch the request
        return $response;
    }
}
