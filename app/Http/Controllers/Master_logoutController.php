<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Master_logoutController extends Controller
{
    public function post()
    {
        return response()->json([
            'auth' => false
        ], 200);
    }
}
