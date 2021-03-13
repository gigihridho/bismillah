<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(){
        if(request()->ajax()){
            $query = Review::with('user');

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                    <div class="btn-group">
                        <form action="' . route('kamar.destroy', $data->id) . '" method="POST"  style="margin-left:10px">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
            }

        return view('pages.admin.reviews.index');
    }
}
