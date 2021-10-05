<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'arrival_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'arrival_date.required' => 'Tanggal masuk harus diisi',
            'arrival_date.date' => 'Tanggal masuk harus berupa tanggal',
        ];
    }
}
