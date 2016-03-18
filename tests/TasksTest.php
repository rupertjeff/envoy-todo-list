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
        $this->get(route('api.tasks.index'))
            ->seeJson([]);

        // Some tasks exist
        factory(Task::class, 4)->create();
        $this->get(route('api.tasks.index'))
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

        $this->post(route('api.tasks.store'), [
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

        $this->delete(route('api.tasks.destroy', $task))
            ->seeJson([
                'deleted' => true,
                'id'      => '' . $task->getKey(),
            ]);
    }

    /**
     * @test
     */
    public function it_responds_with_an_error_when_a_nonexistent_task_is_deleted()
    {
        $this->delete(route('api.tasks.destroy', [1]))
            ->seeJson([
                'error' => 'Task does not exist.',
            ]);
    }

    /**
     * @test
     */
    public function it_returns_a_task()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        /** @var Task $task */
        $task = factory(Task::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->get(route('api.tasks.view', $task))
            ->seeJson([
                'id'          => '' . $task->getKey(),
                'name'        => $task->name,
                'description' => $task->description,
            ]);
    }

    /**
     * @test
     */
    public function it_returns_a_task_and_its_associated_user()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        /** @var Task $task */
        $task = factory(Task::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->get(route('api.tasks.view', $task) . '?with=user')
            ->seeJsonStructure([
                'id',
                'name',
                'description',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_completes_a_task()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        /** @var Task $task */
        $task = factory(Task::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->put(route('api.tasks.complete', $task))
            ->seeJson([
                'id' => '' . $task->getKey(),
                'completed' => ! $task->isComplete(),
            ]);
    }

    /**
     * @test
     */
    public function it_uncompletes_a_task()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        /** @var Task $task */
        $task = factory(Task::class)->create([
            'user_id' => $user->getKey(),
            'completed' => true,
        ]);

        $this->put(route('api.tasks.complete', $task))
            ->seeJson([
                'id' => '' . $task->getKey(),
                'completed' => ! $task->isComplete(),
            ]);
    }
}
