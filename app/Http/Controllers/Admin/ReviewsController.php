<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Review;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $reviews = Review::with('user')->get();
        return view('pages.admin.reviews.index',[
            'reviews' => $reviews
        ]);
    }

    public function destroy($id){
        $item = Review::find($id);
        $item->delete();

        return redirect()->route('reviews.index');
    }
}
