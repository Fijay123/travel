<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassengerRequest extends FormRequest
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
            'names.*' => 'required|distinct',
            'identity.*' => 'required|distinct|numeric|min:6',
            'seat.*' => 'not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'names.*.required' => 'Nama Penumpang Harus Di Isi',
            'names.*.distinct' => 'Nama Penumpang Tidak Boleh Sama',
            'identity.*.required' => 'Nomor identitas Harus Di Isi',
            'identity.*.distinct' => 'Nomor identitas Tidak Boleh Sama',
            'identity.*.numeric' => 'Nomor Identitas Tidak Valid',
            'identity.*.min' => 'Nomor identitas Tidak Valid',
            'seat.*.not_in' => 'Nomor Kursi Penumpang Harus Di Isi',
        ];
    }

    
}
