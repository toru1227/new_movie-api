<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Review;
use App\Models\Movie;
use Carbon\Carbon;

class MoviesController extends Controller
{
    public function get()
    {
        $items = DB::table('movies')->get();
        $score = [];
        $items_data = [];
        foreach ($items as $item) {
            $reviews = DB::table('reviews')->where('movie_id', $item->id)->get();
            $score = 0;
            $count = 0;
            foreach ($reviews as $review) {
                for ($i = 0; $i < count($reviews); $i++) {
                    $score += $review->point;
                    $count++;
                }
            }
            if ($score > 0) {
                $average = round($score / $count, 2);
            } else {
                $average = 0;
            }
            $item_data = [
                "data" => $item,
                "average" => $average
            ];
            array_push($items_data, $item_data);
        }
        return response()->json([
            'message' => 'OK',
            'data' => $items_data
        ], 200);
    }

    public function post(Request $request)
    {
        $item = new Movie;
        $now=Carbon::now();
        $item->title = $request->title;
        $item->release_date = $request->release_date;
        $item->picture=$request->picture;
        $item->text=$request->text;
        $item->created_at =$now;
        $item->updated_at = $now;
        $item->save();
        // if($request->picture!=null){
        //     $request->picture->storeAs('public/images',$request->picture.'.jpg');
        // }
        return response()->json([
            'message' => 'Movie created successfully',
            'data' => $item
        ], 200);
        // $now = Carbon::now();

        // $param = [
        //     "title" => $request->title,
        //     "release_date" => $request->release_date,
        //     "created_at" => $now,
        //     "updated_at" => $now
        // ];
        // DB::table('movies')->insert($param);
        // return response()->json([
        //     'message' => "movie created successfully",
        //     'data' => $param
        // ], 200);
    }

}
