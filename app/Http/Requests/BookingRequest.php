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
        $rules = [ 'name' => 'required|max:255', ]; 
            foreach($this->request->get('name') as $key) { 
                $rules['name.'.$key] = 'required|max:10'; 
            } 
            return $rules; 
    }

    public function messages()
    {
        return [
            'name.required' => 'Kota Asal Belum Di Isi',
           
        ];
    }
}
