<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login a user
     *
     * @param Request $request
     * @return false|string
     */
    public function login(Request $request): bool|string
    {
        $loginData = [];
        if ($request->has('email')) {
            $loginData = [
                'field' => 'email',
                'value' => $request->email
            ];
        }

        if ($request->has('phone_number')) {
            $loginData = [
                'field' => 'phone_number',
                'value' => $request->phone_number
            ];
        }

        if (!$loginData || !isset($request->password)) {
            return json_encode('You need to type your email/phone number and password');
        }

        if (Auth::attempt([$loginData['field'] => $loginData['value'], 'password' => $request->password])) {
            $authUser = Auth::user();
            $token =  $authUser->createToken('MyAuthApp')->plainTextToken;

            return json_encode('User signed in, your token: ' . $token);
        }
        else {
            return json_encode('Unauthorised');
        }
    }

    /**
     * Register a user
     *
     * @param RegisterRequest $request
     * @return false|string
     */
    public function register(RegisterRequest $request): bool|string
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;

        return json_encode($success);
    }
}
