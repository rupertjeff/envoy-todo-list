<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;

/**
 * Class Delete
 *
 * @package App\Http\Requests\Task
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
            //
        ];
    }
}
