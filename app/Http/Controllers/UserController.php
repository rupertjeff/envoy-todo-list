<?php
/**
 * Name: UserController.php
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-16
 * Last Modified: 2016-03-16
 */
namespace App\Http\Controllers;

use App\Database\Models\User;
use App\Http\Requests\User\Create as CreateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return User::all()->toJson();
    }

    public function store(CreateUserRequest $request)
    {
        return User::create($request->only([
            'name',
            'email',
            'password',
        ]))->toJson();
    }
}
