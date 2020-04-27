<?php

namespace App\Http\Requests\APIRequest;
use App\Helpers\APIHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class UpdateUserRequest extends FormRequest
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
    public function rules(Request $request )
    {
        $id = $request->current_user_id;
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
            'contact_no' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ];

    }
    public function messages(){

        return[

            'name.required' => 'Name is required',
            'email.unique' => 'Email already exists',
            'email.required' => 'Email is required',
            'address.required' => 'Address is required',
            'contact_no.required' => 'Contact Number is required',
            'password.required' => 'Password is required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $message = APIHelper::errorsResponse($errors);
        throw new HttpResponseException(response()->json($message, JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
