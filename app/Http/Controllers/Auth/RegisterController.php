<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public $redirectTo = '/email/verify';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3','max:255'],
            'email' => ['required','email', 'max:255', 'unique:users','email:rfc,dns'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['same:password|required'],
            'no_hp' => ['required','numeric', 'digits_between:10,13'],
            'address' => ['required','alpha'],
            'profession' => ['required','alpha'],
            'photo_ktp' => ['required','mimes:png,jpg,jpeg','max:2048'],
        ],[
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'name.min' => 'Nama lengkap tidak boleh kurang dari 3 karakter',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter',
            'name.string' => 'Nama lengkap harus berupa huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.min' => 'Email tidak boleh kurang dari 11 karakter',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
            'no_hp.digits_between' => 'No telp tidak boleh kurang dari 11 angka dan lebih dari 13 angka',
            'no_hp.required' =>  'No telp tidak boleh kosong',
            'no_hp.numeric' => 'No telp harus berisi angka',
            // 'no_hp.unique' => 'No telp sudah ada, masukkan no telp yang lain',
            'password.string' => 'Kata sandi harus berupa huruf atau angka',
            'password.min' => 'Kata sandi tidak boleh kurang dari 8 karakter',
            'password.confirmed' => 'Kata sandi tidak sama',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password_confirmation.same' => 'Konfirmasi kata sandi tidak sama',
            'password_confirmation.required' => 'Konfirmasi Kata sandi tidak boleh kosong',
            'address.required' => 'Alamat asal tidak boleh kosong',
            'address.alpha' => 'Alamat asal harus berupa huruf',
            'profession.required' => 'Pekerjaan tidak boleh kosong',
            'profession.alpha' => 'Pekerjaan harus berupa huruf',
            'photo_ktp.required' => 'Foto ktp tidak boleh kosong',
            'photo_ktp.mimes' => 'Foto ktp harus berupa file png,jpg, atau jpeg',
            'photo_ktp.max' => 'Ukuran foto ktp tidak boleh lebih dari 2MB'
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'no_hp' => $data['no_hp'],
            'address' => $data['address'],
            'profession' => $data['profession']
        ]);
        if(request()->hasFile('photo_ktp')){
            $photo_ktp = request()->file('photo_ktp')->store('assets/user','public');
            $user->update(['photo_ktp' => $photo_ktp]);
        }
        $user->assignRole('user');
        return $user;
    }
}
