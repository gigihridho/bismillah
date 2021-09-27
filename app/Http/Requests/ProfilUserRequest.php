<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'profession' => 'required|alpha',
            'address' => 'required|string',
            'photo_ktp' => 'image|max:2048|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'name.min' => 'Nama lengkap tidak boleh kurang dari 3 karakter',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter',
            'name.string' => 'Nama lengkap harus berupa huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email harus berupa huruf atau angka',
            'email.min' => 'Email tidak boleh kurang dari 11 karakter',
            'email.email' => 'Email tidak valid',
            'email.regex' => 'Masukkan email yang benar',
            'no_hp.digits_between' => 'No telp tidak boleh kurang dari 11 angka dan lebih dari 13 angka',
            'no_hp.required' =>  'No telp tidak boleh kosong',
            'no_hp.numeric' => 'No telp harus berisi angka',
            'address.required' => 'Alamat asal tidak boleh kosong',
            'address.string' => 'Alamat asal harus berupa huruf',
            'profession.required' => 'Pekerjaan tidak boleh kosong',
            'profession.alpha' => 'Pekerjaan harus berupa huruf',
            'photo_ktp.mimes' => 'Foto ktp harus berupa file png,jpg, atau jpeg',
            'photo_ktp.max' => 'Ukuran foto ktp tidak boleh lebih dari 2MB',
            'photo_ktp.image' => 'Foto Ktp harus berupa gambar'
        ];
    }
}

