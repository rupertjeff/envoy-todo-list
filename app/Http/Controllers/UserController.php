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

class UserController extends Controller
{
    public function index()
    {
        return User::all()->toJson();
    }
}
