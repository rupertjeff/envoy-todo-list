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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function tasks()
    {
        return response()
            ->json([
                'title'   => 'Tasks',
                'content' => view('templates.tasks.index')->render(),
            ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function createTask()
    {
        return response()
            ->json([
                'title'   => 'Create Task',
                'content' => view('templates.tasks.create')->render(),
            ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function users()
    {
        return response()
            ->json([
                'title' => 'Users',
                'content' => view('templates.users.index')->render(),
            ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function createUser()
    {
        return response()
            ->json([
                'title' => 'Create User',
                'content' => view('templates.users.create')->render(),
            ]);
    }
}
