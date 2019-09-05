<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\models\Payment;
use Illuminate\Http\Request;


class PaymentRequest extends FormRequest
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
        $payment = Payment::where('id', $request->payment_id)->first();
        $rules = [
            'bank_from' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|numeric',
            'bank_to' => 'not_in:0',
            'transfer' => 'required|numeric',
            //'file' => 'required|mimes:jpeg,jpg,png',
        ];

        if ($payment == null ){
            $rules['file'] = 'required|mimes:jpeg,jpg,png';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'bank_from.required' => 'Bank Pengirim Harus Di Isi',
            'account_name.required' => 'Nama Pemilik Rekening Harus Di Isi',
            'account_number.required' => 'Nomor Rekening Pengirim Harus Di Isi',
            'account_number.numeric' => 'Nomor Rekening Tidak Valid',
            'bank_to.not_in' => 'Bank Tujuan Transfer Harus Di Pilih',
            'transfer.required' => 'Jumlah Transfer Harus Di Isi',
            'transfer.numeric' => 'Jumlah Transfer Tidak Valid',
            'file.required' => 'Bukti Transfer Harus Di Isi',
            'file.mimes' => 'Bukti Transfer Tidak Valid',
        ];
    }
}
