<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
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
            'nama' => 'required|alpha',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Fasilitas harus diisi',
            'nama.alpha' => 'Fasilitas harus berbentuk huruf'
        ];
    }
}
