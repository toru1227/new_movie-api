<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditMovieController extends Controller
{
    public function get(Request $request)
    {
        $item = DB::table('movies')->where('id', $request->id)->first();
        if ($item) {
            return response()->json([
                'message' => 'ok',
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'ok',
                'data' => "do not exist"
            ], 200);
        }
    }
    public function update(Request $request)
    {
        $param = [
            'title' => $request->title,
            'release_date' => $request->release_date
        ];
        DB::table('movies')->where('id', $request->id)->update($param);
        return response()->json([
            'message' => 'update ok',
            'data' => $param
        ], 200);
    }
    public function delete(Request $request)
    {
        DB::table('movies')->where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Movie deleted successfully',
        ], 200);
    }
}
