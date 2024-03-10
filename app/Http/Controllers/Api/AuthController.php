<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'nullable',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'fmc_token' => '',
                'phone_number' => 'required',
                'address' => 'required'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()->first()
                ];
                return response()->json($response, 400);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['first_name'] = $request->first_name;
            $input['last_name'] = $request->last_name;
            $input['email'] = $request->email;
            $input['phone_number'] = $request->phone_number;
            $input['fmc_token'] = $request->fmc_token;
            $input['name'] = $request->first_name . ' ' . $request->last_name;
            $user = User::create($input);
            $success['token'] = $user->createToken('DonorConnect')->plainTextToken;
            $response = [
                'success' => true,
                'data' => [
                    'token' => $success,
                    'message' => 'User Registered Successfully',
                    'user_details' => $user
                ]
            ];
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('DonorConnect')->plainTextToken;

            $response = [
                'success' => true,
                'data' => [
                    'token' => $token,
                    'user_details' => $user
                ],
                'message' => 'User Logged In Successfully'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'UnAuthorized Error'
            ];

            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        try {

            $user->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'user' => $user,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
