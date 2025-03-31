<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // return $users;
        return response()->json($users); 
    }

    public function store(Request $request) {
        $user = $request->getContent();
        $validate = Validator::make($user, [
            'username' => 'required|min:3|max:255',
            'password' =>  'required|min:3|max:255' 
        ]);

        if($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ], 422);
        }
        Log::info(json_encode($user));
    }
}
