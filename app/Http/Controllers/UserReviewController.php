<?php

namespace App\Http\Controllers;

use App\Booking;
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
        // $user = User::where('id',Auth::user()->id)->get();
        // $review = Review::where('user_id',Auth::user()->id)->get();

        $booking = Booking::with(['review','user'])->where('user_id',Auth::user()->id)->where('status',"Sukses")->first();
        $id = $booking->id;
        $review = Review::where('booking_id',$id)->get();
        return view('pages.user.review.edit',[
            'review' => $review,
            'booking' => $booking,

        ]);
    }

    public function update(Request $request, $redirect){
        $user = User::where('id',Auth::user()->id)->first()->id;
        // $item = Review::where('user_id', $user)->first();
        $item = Booking::where('id', $user)->first();
        $booking = Booking::with(['review','user'])->where('user_id',Auth::user()->id)->where('status',"Sukses")->get();
        $booking_id = Review::where('booking_id',$booking)->first();
        if($item == null){
            $item = new Review();
            $item->review = $request->review;
            $item->booking_id = $request->input('booking_id');
            $item->save();
        }else {
            if($request->review != null){
                $item->review = $request->review;
                $item->booking_id = $request->input('booking_id');
                $item->save();
            }
        }
        Alert::success('SUCCESS','Review Berhasil ditambah');
        return redirect()->route($redirect);
    }
}
