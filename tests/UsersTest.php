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
            ->seeJsonStructure([]);

        // Some users exist
        factory(\App\Database\Models\User::class, 4)->create();
        $this->get('users')
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
        $this->withoutMiddleware();
        $this->post('users', [
            'name'                  => 'New User',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ])->seeJson([
            'id'    => 1,
            'name'  => 'New User',
            'email' => 'test@example.com',
        ]);
    }
}
