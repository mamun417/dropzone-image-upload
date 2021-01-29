<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
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
        $id = $this->data->id ?? null;

        return [
//            'name' => 'required|string|unique:data,name,' . $id,
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ];
    }
}
