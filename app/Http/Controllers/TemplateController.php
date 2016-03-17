<?php
/**
 * Name: TemplateController.php
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-17
 * Last Modified: 2016-03-17
 */
namespace App\Http\Controllers;

/**
 * Class TemplateController
 *
 * @package App\Http\Controllers
 */
class TemplateController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function tasks()
    {
        return view('templates.tasks.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function createTask()
    {
        return view('templates.tasks.create');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function users()
    {
        return view('templates.users.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function createUser()
    {
        return view('templates.users.create');
    }
}
