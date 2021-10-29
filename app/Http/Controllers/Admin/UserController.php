<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        $users = User::role('user')->get();
        return view('pages.admin.user.index',[
            'users' => $users,
        ]);
    }

    public function create(){
        return view('pages.admin.user.create');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','min:3','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => ['required', 'string', 'min:8'],
            'no_hp' => ['required','numeric', 'digits_between:10,13','unique:users'],
        ],[
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'name.min' => 'Nama lengkap tidak boleh kurang dari 3 karakter',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter',
            'name.string' => 'Nama lengkap harus berupa huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email harus berupa huruf atau angka',
            'email.min' => 'Email tidak boleh kurang dari 11 karakter',
            'email.email' => 'Email tidak valid',
            'email.regex' => 'Masukkan email yang benar',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
            'no_hp.digits_between' => 'No telp tidak boleh kurang dari 11 angka dan lebih dari 13 angka',
            'no_hp.required' =>  'No telp tidak boleh kosong',
            'no_hp.numeric' => 'No telp harus berisi angka',
            'no_hp.unique' => 'No telp sudah ada, masukkan no telp yang lain',
            'password.string' => 'Kata sandi harus berupa huruf atau angka',
            'password.min' => 'Kata sandi tidak boleh kurang dari 8 karakter',
            'password.required' => 'Kata sandi tidak boleh kosong',
        ]);
    }

    public function store(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make('password');
        $user->no_hp = $request->input('no_hp');
        $user->assignRole('user');
        $user->save();
        $user->sendEmailVerificationNotification();

        Alert::success('SUCCESS','User Berhasil Ditambah');
        return redirect()->route('user.index');
    }
    public function show($id){
        $user = User::where('id',$id)->get();
        return view('pages.admin.user.detail',[
            'user' => $user,
        ]);
    }

    public function newPassword(Request $request, $id){
        $user = User::where('id',$id)->get();
        return view('pages.admin.user.kata-sandi-baru',[
            'user' => $user,
        ]);
    }

    public function newPasswordd(Request $request, $id){
        $user = User::where('id',$id)->first();
        $user->update([
            'password' => Hash::make($request->get('password'))
        ]);

        // dd($user);
        Alert::success('SUCCESS','Kata Sandi Berhasil Diubah');
        return redirect()->route('user.index');
    }

    public function destroy($id){
        $user = User::find($id);

        foreach ($user->bookings as $booking) {
            $booking->delete();
        }
        if($user->delete()){

            return redirect()->route('user.index');
        }

        // foreach ($user->bookings as $booking) {
        //     $booking->delete();
        //     $booking->kamar->status = 1;
        // }
        // $user->bookings->kamar->status = 1;
        // $user->delete();

        return redirect()->back()->withErrors(array('message' => 'Maaf, data user tidak terhapus'));
    }
}
