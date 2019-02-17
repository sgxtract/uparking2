<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddVehicle extends FormRequest
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
            'plate_number' => 'required|alpha_num|unique:vehicles',
            'type' => 'required',
        ];
    }
}
