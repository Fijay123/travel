<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'departure' => 'required',
            'destination' => 'required',
            'time' => 'required',
            'meeting_point' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'departure.required' => 'Kota Asal Belum Di Isi',
            'destination.required' => 'Kota Tujuan Belum Di Isi',
            'time.required' => 'Jam Keberangkatan Belum Di Isi',
            'meeting_point.required' => 'Titik Kumpul Belum Di Isi'
        ];
    }
}
