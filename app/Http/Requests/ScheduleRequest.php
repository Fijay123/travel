<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'date' => 'required',
            'route' => 'required|not_in:0',
            'driver' => 'required|not_in:0',
            'car' => 'required|not_in:0',
            'price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Tanggal Keberangkatan Belum Di Isi',
            'route.not_in' => 'Trayek Belum Di Pilih',
            'driver.not_in' => 'Driver Belum Di Pilih',
            'car.not_in' => 'Armada Belum Di Pilih',
            'price.required' => 'Harga Tiket Belum Di Isi',
            'price.numeric' => 'Harga Tiket Tidak Valid'
        ];
    }
}
