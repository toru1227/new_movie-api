<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function get()
    {
        $items = DB::table('movies')->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }
    public function post(Request $request)
    {
        $param = [
            "title" => $request->title,
            "release_date" => $request->release_date
        ];
        DB::table('movies')->insert($param);
        return response()->json([
            'message' => "movie created successfully",
            'data' => $param
        ], 200);
    }
}
