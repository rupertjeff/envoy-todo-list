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
            ->see('task-list')
            ->see('task.name');
    }

    /**
     * @test
     */
    public function it_returns_create_task_template()
    {
        $this->get(route('templates.tasks.create'))
            ->see('Description (optional)');
    }

    /**
     * @test
     */
    public function it_returns_users_template()
    {
        $this->get(route('templates.users.index'))
            ->see('user-list')
            ->see('user.name');
    }

    /**
     * @test
     */
    public function it_returns_create_user_template()
    {
        $this->get(route('templates.users.create'))
            ->see('Email');
    }
}
