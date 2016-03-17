<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class Delete
 *
 * @package App\Http\Requests\User
 */
class Delete extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Normally this would require authentication.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // No rules, because id is required in the route.
        return [
        ];
    }
}
