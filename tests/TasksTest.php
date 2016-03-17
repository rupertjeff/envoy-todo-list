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
                    'name',
                    'description',
                ],
            ]);
    }
}
