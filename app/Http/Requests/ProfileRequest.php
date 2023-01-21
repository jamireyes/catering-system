<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'phone_number' => ['required', 'numeric', 'digits:10'],
            'address_1' => ['required', 'min:5', 'max:100'],
            'address_2' => ['max:100'],
            'city' => ['required', 'max:100'],
            'state' => ['required', 'max:100'],
            'zipcode' => ['required', 'numeric']
        ];
    }
}
