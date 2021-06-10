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

    public function review()
    {
        $user = Auth::user()->id;
        $review = Review::where('review',$user)->get();

        return view('pages.user.review.edit',[
            'user' => $user,
            'review' => $review,
        ]);
    }

    public function update(Request $request, $redirect){
        $user = Auth::user()->id;
        $item = Review::where('review', $user)->get();

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
