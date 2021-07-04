<?php

namespace App\Http\Controllers\Admin;

use App\RoomBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $transaction = RoomBooking::all();
        return view('pages.admin.transaksi.index',[
            'transaction' => $transaction
        ]);
    }
}
