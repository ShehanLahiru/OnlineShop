<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\APIRequest\CreateUserRequest;
use App\Http\Requests\APIRequest\UpdateUserRequest;

class UserController extends Controller
{
    protected $jwt;

    public function __construct(\Tymon\JWTAuth\JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    public function login(Request $request)
    {
        if (!$request->password) {

            return APIHelper::makeAPIResponse(false, "Password required", null, 401);
        } else {
            $user = User::where('email', $request->email)->first();

            if ($user) {

                $id = $user->id;
                $user_type = $user->user_type;
                $email = $request->input('email');
                $password = $request->input('password');
                $credentials = request(['email', 'password'], $user_type);

                $payload = $this->jwt->factory()
                    ->setTTL(60 * 24 * 365)
                    ->customClaims([
                        'sub' => $id,
                        'data' => [
                            'email' => $email,
                            'password' => $password,
                            'user_type' => $user_type,
                        ]
                    ])
                    ->make();

                $token = $this->jwt->manager()->encode($payload)->get();

                if (!$token = auth('api')->attempt($credentials)) {

                    return APIHelper::makeAPIResponse(false, "Invalid credentials", null, 401);
                } else {
                    $data = array();
                    $data['name'] = $user->name;
                    $data['address'] = $user->address;
                    $data['image_url'] = $user->image_url;
                    $data['token'] = $token;
                    return APIHelper::makeAPIResponse(true, "Logged in", $data, 200);
                }
            } else {
                return APIHelper::makeAPIResponse(false, "Invalid credentials", null, 401);
            }
        }
    }

    public function register(CreateUserRequest $request)
    {
        try {
            $url = APIHelper::uploadFileToStorage($request->file('image'), 'public/common_media');
            $user = new User();
            $user->name = $request->input('name');
            $user->image_url = $url;
            $user->user_type = 'user';
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->contact_no = $request->input('contact_no');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return $this->login($request);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

    public function userProfile(Request $request)
    {
        try {
            $user = User::find($request->current_user_id);

            return APIHelper::makeAPIResponse(true, "User Details Found", $user, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

    public function updateUser(UpdateUserRequest $request)
    {
        try {

            $user = User::find(auth()->user()->id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->contact_no = $request->input('contact_no');
            $user->password = bcrypt($request->input('password'));
            if ($request->hasFile('image')) {

                $url = APIHelper::uploadFileToStorage($request->file('image'), 'public/common_media');
                $user->image_url = $url;
            }
            $saved = $user->save();
            return APIHelper::makeAPIResponse(true, "User Updated", $saved, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->current_user_id);
            if ($user) {
                $user->delete();
                JWTAuth::invalidate($request->token);
                return APIHelper::makeAPIResponse(true, "User Deleted", null, 200);
            } else {
                return APIHelper::makeAPIResponse(false, "User not found", null, 404);
            }
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
    public function updateImage(Request $request)
    {

        try {

            $user = User::find(auth()->user()->id);

            if ($request->hasFile('image')) {

                $url = APIHelper::uploadFileToStorage($request->file('image'), 'public/common_media');
                $user->image_url = $url;
            }
            $saved = $user->save();
            return APIHelper::makeAPIResponse(true, "User Profile Updated", $user->image_url, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }




    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);

            return APIHelper::makeAPIResponse(true, "User logged out successfully", null, 200);
        } catch (JWTException $exception) {
            return APIHelper::makeAPIResponse(false, "Sorry, the user cannot be logged out", null, 500);
        }
    }
}
