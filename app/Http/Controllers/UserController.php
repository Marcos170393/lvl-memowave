<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // return $users;
        return response()->json($users); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:255|unique:users,username',
            'password' =>  'required|min:3|max:255'
        ]);
        
        $data = json_decode($request->getContent());
        try {
            $user = new User;
            $user->username = $data->username;
            $user->password = Hash::make($data->password);
            $user->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
        return response('success', 200);
    }
}
