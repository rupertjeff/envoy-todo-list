<?php

/**
 * Name: TasksTest.php
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-16
 * Last Modified: 2016-03-16
 */
class TasksTest extends TestCase
{
    /**
     * @test
     */
    public function it_shows_a_listing_of_the_current_tasks()
    {
        // No tasks
        $this->get('tasks')
            ->seeJson([]);

        // Some tasks exist
        factory(\App\Database\Models\Task::class, 4)->create();
        $this->get('tasks')
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'user_id',
                    'name',
                    'description',
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_creates_a_task()
    {
        $user = factory(\App\Database\Models\User::class)->create();

        $this->post('tasks', [
            'name' => 'Task 1',
            'user_id' => $user->getKey()
        ])->seeJson([
            'id' => 1,
            'user_id' => $user->getKey(),
            'name' => 'Task 1',
            'description' => null,
        ]);
    }
}
