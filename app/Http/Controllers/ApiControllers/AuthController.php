<?php

namespace App\Http\Controllers\ApiControllers;


use App\Http\Controllers\Controller;
use App\Models\Dog;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'ownername' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users', // Ensure the table name is correct
        'dogname' => 'required|string|max:255',
        'dogbirthday' => 'required|date_format:Y-m-d',
        'password' => 'required|string|min:8',
        'confirmpassword' => 'required|string|same:password', // Ensure passwords match
        'dogdetail' => 'nullable|string|max:255', // Make dogdetail optional
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Create the user
    $user = Dog::create([
        'ownername' => $request->ownername,
        'email' => $request->email,
        'dogname' => $request->dogname,
        'dogbirthday' => $request->dogbirthday,
        'password' => Hash::make($request->password),
        'dogdetail' => $request->dogdetail,
    ]);

    // Generate a token (if needed)
    // $token = $user->createToken('auth_token')->accessToken;

    // Return successful response
    return response()->json([
        'message' => 'Registration successful.',
        'user' => $user,
    ], 201); // 201 Created status code
}


public function login(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'email' => 'required|string',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return response()->json(['Error' => $validator->errors()->first()], 422);
    }

    // Retrieve the input data
    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];


    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();

    // Create an access token for the user
    $token = $user->createToken('Personal Access Token')->accessToken;

    return response()->json([
                        'message' => 'Login successful.',
                        'user' => $user,
                        'token' => $token,
                    ]);

    // dd( auth()->attempt($credentials));
    // // Attempt to authenticate the user
    // if (!$token = auth()->attempt($credentials)) {
    //     return response()->json(['Error' => 'Invalid credentials'], 401);
    // }

    // if (Auth::attempt([
    //             'email' => $validateData['email'],
    //             'password' => $validateData['password'],
    //         ])) {
    //             $user = Auth::user();  // Get the authenticated user
    //             $token = $user->createToken('auth_token')->accessToken;

    //             return response()->json([
    //                 'message' => 'Login successful.',
    //                 'user' => $user,
    //                 'token' => $token,
    //             }
    // Authentication successful, create login history
//     $cDataTime = now(); // Or use $this->getUtcTime() if you have that method
//     Loginhistory::create([
//         'user_id' => auth()->user()->id,
//         'created_at' => $cDataTime,
//         'updated_at' => $cDataTime,
//     ]);

//     // Return the response with the token
//     return response()->json($this->respondWithToken($token));
}

    // public function login(Request $request)
    // {
    //     // Validate the request data
    //     $validateData = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     // Attempt to authenticate the user
    //     if (Auth::attempt([
    //         'email' => $validateData['email'],
    //         'password' => $validateData['password'],
    //     ])) {
    //         $user = Auth::user();  // Get the authenticated user
    //         $token = $user->createToken('auth_token')->accessToken;

    //         return response()->json([
    //             'message' => 'Login successful.',
    //             'user' => $user,
    //             'token' => $token,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Invalid credentials.',
    //         ], 401);
    //     }
    // }
    public function createReservation(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pet_name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20', // Adjust length as needed
            'indate' => 'required|date_format:Y-m-d',
            'outdate' => 'required|date_format:Y-m-d',
            'pet_behavior' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'package_details' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the reservation
        $reservation = Reservation::create([
            'owner_name' => $request->owner_name,
            'email' => $request->email,
            'pet_name' => $request->pet_name,
            'phone_no' => $request->phone_no,
            'indate' => $request->indate,
            'outdate' => $request->outdate,
            'pet_behavior' => $request->pet_behavior,
            'payment_status' => $request->payment_status,
            'package_details' => $request->package_details,
        ]);

        // Return successful response
        return response()->json([
            'message' => 'Reservation created successfully.',
            'reservation' => $reservation
        ], 201);
    }

    public function getAllUsers()
    {
        $users = Dog::all();
        return response()->json($users);
    }

    public function allreservation()
    {
        $users = Reservation::all();
        return response()->json($users);
    }


    public function getUserById($id)
    {
        $user = Dog::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
