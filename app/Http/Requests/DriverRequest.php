<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Driver;
use Illuminate\Http\Request;


class DriverRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $driver = Driver::where('id', $request->driver_id)->first();
        $rules = [
            'name' => 'required',
            'license' => 'required|numeric',
            'phone' => 'required|numeric',
            'address' => 'required'
        ];

        if ($driver == null ){
            $rules['file'] = 'required|mimes:jpeg,jpg,png';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Driver Harus Di Isi',
            'license.required' => 'Nomor SIM Harus Di Isi',
            'license.numeric' => 'Nomor SIM Tidak Valid',
            'phone.numeric' => 'Nomor Telp Tidak Valid',
            'phone.required' => 'Nomor Telp Harus Di Isi',
            'address.required' => 'Alamat Driver Harus Di Isi',
            'file.required' => 'Foto Driver Harus Di Isi',
            'file.mimes' => 'Foto Driver Tidak Valid',
        ];
    }
}
