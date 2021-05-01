<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $now = Carbon::now();
        $hash_password = Hash::make($request->password);
        $error=DB::table('users')->where('email',$request->email)->get();
        if($error){
            return response()->json([
                'message' => 'duplicate',
                'data' => $request->email
            ], 200);
        }
        $param = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hash_password,
            "created_at" => $now,
            "updated_at" => $now
        ];
        DB::table('users')->insert($param);
        return response()->json([
            'message' => 'User created successfully',
            'data' => $param
        ], 200);
  }
}
