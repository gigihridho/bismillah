<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = User::role('user')->get()->count();
        return view('pages.admin.dashboard',[
            'user' => $user
        ]);
    }
}
