<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseEditRequest extends FormRequest
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
            'description' => 'required|string',
            'nominal' => 'required|numeric',
            'date' => 'required|date',
            'photo' => 'image','mimes:png,jpg,jpeg','max:2048'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa huruf',
            'nominal.required' => 'Nominal tidak boleh kosong',
            'nominal.numeric' => 'Nominal harus berupa angka',
            'date.required' => 'Tanggal tidak boleh kosong',
            'date.date' => 'Tanggal harus berupa tanggal',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Format foto harus berupa file png,jpg, atau jpeg',
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 2 MB'
        ];
    }
}
