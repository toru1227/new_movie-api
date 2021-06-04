<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        $item = Review::where('id', $request->id)->first();
        return response()->json([
            'message' => 'OK',
            'data' => $item
        ], 200);
    }
    public function update(Request $request)
    {
        $item = Review::where('id', $request->id)->first();
        $item->content = $request->content;
        $item->point = $request->point;
        $item->save();
        if ($item) {
            return response()->json([
                'message' => $item,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
