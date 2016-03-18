<?php

use App\Database\Models\Task;
use App\Database\Models\User;

/**
 * Name: UsersTest.php
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-16
 * Last Modified: 2016-03-16
 */
class UsersTest extends TestCase
{
    /**
     * @test
     */
    public function it_shows_a_listing_of_the_current_users()
    {
        // No users
        $this->get(route('api.users.index'))
            ->seeJsonStructure([]);

        // Some users exist
        factory(User::class, 4)->create();
        $this->get(route('api.users.index'))
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_creates_a_user()
    {
        $this->post(route('api.users.store'), [
            'name'  => 'New User',
            'email' => 'test@example.com',
        ])->seeJson([
            'id'    => 1,
            'name'  => 'New User',
            'email' => 'test@example.com',
        ]);
    }

    /**
     * @test
     */
    public function it_deletes_a_user()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->delete(route('api.users.destroy', $user))
            ->seeJson([
                // Quick way to force the key to be a string, as we’re not using
                // a transformer for the api responses.
                'id'      => '' . $user->getKey(),
                'deleted' => true,
            ]);

        $user = factory(User::class)->create();
        factory(Task::class, 10)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->delete(route('api.users.destroy', $user))
            ->dontSeeInDatabase('tasks', [
                'user_id' => $user->getKey(),
            ]);
    }

    /**
     * @test
     */
    public function it_responds_with_error_when_nonexistent_user_is_deleted()
    {
        $this->delete(route('api.users.destroy', [1]))
            ->seeJson([
                'error' => 'User does not exist.',
            ]);
    }

    /**
     * @test
     */
    public function it_returns_a_user()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->get(route('api.users.view', $user))
            ->seeJson([
                'id'    => '' . $user->getKey(),
                'name'  => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * @test
     */
    public function it_returns_a_user_and_an_associated_task_list()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        factory(Task::class, 10)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->get(route('api.users.view', $user) . '?with=tasks')
            ->seeJsonStructure([
                'id',
                'name',
                'email',
                'tasks' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_returns_a_users_task_list()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        factory(Task::class, 10)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->get(route('api.users.tasks', $user))
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_responds_with_error_when_a_nonexistent_users_tasks_are_requested()
    {
        factory(Task::class, 10)->create([
            'user_id' => 1,
        ]);

        $this->get(route('api.users.tasks', [1]))
            ->seeJson([
                'error' => 'User does not exist.',
            ]);
    }
}
