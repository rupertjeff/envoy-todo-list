<?php

/**
 * Name: TemplatesTest.php
 * Description:
 * Version: 0.0.1
 * Author: jeffr
 * Created: 2016-03-17
 * Last Modified: 2016-03-17
 */
class TemplatesTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_tasks_template()
    {
        $this->get(route('templates.tasks.index'))
            ->seeJsonStructure([
                'title',
                'content',
            ])->seeJson([
                'title' => 'Tasks',
            ]);
    }

    /**
     * @test
     */
    public function it_returns_create_task_template()
    {
        $this->get(route('templates.tasks.create'))
            ->seeJsonStructure([
                'title',
                'content',
            ])->seeJson([
                'title' => 'Create Task',
            ]);
    }

    /**
     * @test
     */
    public function it_returns_users_template()
    {
        $this->get(route('templates.users.index'))
            ->seeJsonStructure([
                'title',
                'content',
            ])->seeJson([
                'title' => 'Users',
            ]);
    }
}
