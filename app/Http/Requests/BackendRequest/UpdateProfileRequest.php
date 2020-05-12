<?php

use App\Http\Requests;
namespace App\Http\Requests\BackendRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateProfileRequest extends FormRequest
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
        $id = Auth::user()->id;
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
            'shop_id' => 'required',

        ];

    }
    public function messages(){

        return[
            'name.required' => 'Name is required',
            'email.unique' => 'Email already exists',
            'email.required' => 'Email is required',
            'shop_id.required' => 'Address is required',
        ];
    }
}
