<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class UserReviewController extends Controller
{
    public function get(Request $request)
    {
        $item = Review::where('user_id', $request->id)->get();
        return response()->json([
            'message' => 'OK',
            'data' => $item
        ], 200);
    }
}
