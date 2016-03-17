<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_shows_a_listing_of_the_current_users()
    {
        // No users
        $this->get('users')
            ->seeJson([]);
    }
}
