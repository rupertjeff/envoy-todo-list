<?php
use App\Database\Models\Task;
use App\Database\Models\User;

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
        factory(Task::class, 4)->create();
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
        $user = factory(User::class)->create();

        $this->post('tasks', [
            'name'    => 'Task 1',
            'user_id' => $user->getKey(),
        ])->seeJson([
            'id'          => 1,
            'user_id'     => $user->getKey(),
            'name'        => 'Task 1',
            'description' => null,
        ]);
    }

    /**
     * @test
     */
    public function it_deletes_a_task()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->delete('tasks/' . $task->getKey())
            ->seeJson([
                'deleted' => true,
                'id'      => '' . $task->getKey(),
            ]);
    }
}
