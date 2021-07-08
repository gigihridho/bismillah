<?php

namespace App\Http\Controllers;

use App\Review;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function review(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->get();
        $review = Review::where('user_id',Auth::user()->id)->get();
        // dd($review);
        // if(!is_null($request->get('review'))){
        //     $review->where('user_id',$request->get('review'));
        // }

        // $review->first();
        return view('pages.user.review.edit',[
            'review' => $review,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $redirect){
        $user = User::where('id',Auth::user()->id)->first()->id;
        $item = Review::where('user_id', $user)->first();

        if($item == null){
            $item = new Review();
            $item->review = $request->review;
            $item->user_id = $user;
            $item->save();
        }else {
            if($request->review != null){
                $item->review = $request->review;
                $item->user_id = $user;
                $item->save();
            }
        }

        Alert::success('SUCCESS','Review Berhasil ditambah');
        return redirect()->route($redirect);
    }
}
