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
use Illuminate\Http\Request;
use App\Http\Requests\User\Create as CreateUserRequest;
use App\Http\Requests\User\Delete as DeleteUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()
            ->json(User::all());
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->only([
            'name',
            'email',
        ]);
        // Hardcoded password because it’s not needed for this example, though
        // a more standardized implementation would use it.
        $data['password'] = 'password';

        return response()
            ->json(User::create($data));
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request, $id)
    {
        if ($with = $request->query('with')) {
            if ( ! is_array($with)) {
                $with = explode(',', $with);
            }
            $user = User::with($with)->findOrFail($id);
        } else {
            $user = User::findOrFail($id);
        }

        return response()
            ->json($user);
    }

    public function tasks($id)
    {
        try {
            return response()
                ->json(User::findOrFail($id)->tasks);
        } catch (ModelNotFoundException $e) {
            return response()
                ->json([
                    'error' => 'User does not exist.',
                ]);
        }
    }

    /**
     * @param DeleteUserRequest $request
     * @param int               $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DeleteUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            // Avoid having orphaned items in the database. The spec requires a
            // task to be associated to a user. Better ways to handle this could
            // be to let tasks be unassigned, or to have the foreign constraint
            // cascade the delete or cascade to null on user delete.
            $user->tasks()->delete();
            $user->delete();

            // Would usually use a transformer of some kind to make sure the data
            // being sent is formatted correctly, such as making the key an int.
            return response()
                ->json([
                    'deleted' => true,
                    'id'      => $user->getKey(),
                ]);
        } catch (ModelNotFoundException $e) {
            return response()
                ->json([
                    'error' => 'User does not exist.',
                ]);
        }
    }
}
