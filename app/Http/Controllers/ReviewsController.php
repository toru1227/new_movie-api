<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Review::all();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Review;
        $item->movie_id = $request->movie_id;
        $item->user_id = $request->user_id;
        $item->content = $request->content;
        $item->point = $request->point;
        $item->save();
        return response()->json([
            'message' => 'Review created successfully',
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $items = Review::where('movie_id', $request->id)->get();
        $items_data = array();
        $likes_data = array();
        foreach ($items as $item) {
            $like = DB::table('likes')->where('review_id', $item->id)->get();
            $user_id = $item->user_id;
            $user = DB::table('users')->where('id', (int)$user_id)->first();
            // $likes_data = ["like" => $like];
            // $user_data = ["name" => $user];
            // array_push($items_data, $item);
            // array_push($items_data, $likes_data);
            // array_push($items_data, $user_data);
            // echo '<pre>';
            // print_r($user);
            // echo '<pre>';
            $item_data = [
                "item" => $item,
                "like" => $like,
                "user_data" => $user
            ];
            array_push($items_data, $item_data);
        }

        return response()->json([
            'data' => $items_data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Review::where('id', $request->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Review deleted successfully'
            ], 200);
        } else {
            return response()->json(
                [
                    'message' => 'Review not found'
                ],
                404
            );
        }
    }
}
