<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhonebookRequest extends FormRequest
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
            'tn'=>'required|numeric',
            'name'=>'required|max:25',
            'lastname'=>'required|max:32',
            'patronymic'=>'required|max:25',
            'birthday'=>'required|max:10',
            'phone_mobile'=>'required|max:13|unique:phonebooks',
            'phone_home'=>'required|max:13|unique:phonebooks'
        ];
    }
}
