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
