<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Master_loginController extends Controller
{
    public function post(Request $request)
    {
        $item = DB::table('master_user')->where('email', $request->email)->first();
        if (!$item) {
            return response()->json([
                'auth' => false
            ], 200);
        }
        if ($item->password == $request->password) {
            return response()->json([
                'auth' => true

            ], 200);
        } else {
            return response()->json([
                'auth' => false
            ], 200);
        }
    }
}
