<?php

use App\Http\Requests;
namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'shop_id' => 'required',
            'password' => 'required|min:6',
        ];
    }
    public function messages(){

        return[

            'name.required' => 'Name is required',
            'email.unique' => 'Email already exists',
            'email.required' => 'Email is required',
            'shop_id.required' => 'Address is required',
            'password.required' => 'Password is required',
        ];
    }
}
