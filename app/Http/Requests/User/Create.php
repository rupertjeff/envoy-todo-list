<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class Create
 *
 * @package App\Http\Requests\User
 */
class Create extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Normally this would require authentication. For the purposes of this
        // example, everyone can create users
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
            'email' => 'required|email|unique:users,email',
        ];
    }
}
