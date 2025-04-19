<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
       

       $user = User::create([
        'name'
       ])

        // Return a response
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
}
