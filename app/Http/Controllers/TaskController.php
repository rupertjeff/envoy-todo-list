<?php
/**
 * Name: TaskController.php
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-16
 * Last Modified: 2016-03-16
 */
namespace App\Http\Controllers;

use App\Database\Models\Task;
use App\Http\Requests\Task\Create as CreateTaskRequest;
use App\Http\Requests\Task\Delete as DeleteTaskRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class TaskController
 *
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()
            ->json(Task::all());
    }

    /**
     * @param CreateTaskRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTaskRequest $request)
    {
        return response()
            ->json(Task::create($request->only('user_id', 'name', 'description')));
    }

    /**
     * @param DeleteTaskRequest $request
     * @param int               $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DeleteTaskRequest $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return response()
                ->json([
                    'deleted' => true,
                    'id'      => $task->getKey(),
                ]);
        } catch (ModelNotFoundException $e) {
            return response()
                ->json([
                    'error' => 'Task does not exist.',
                ]);
        }
    }
}
