<?php
use App\Database\Models\User;
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
        factory(User::class, 4)->create();
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

    /**
     * @test
     */
    public function it_deletes_a_user()
    {
        /** @var User $user */
        $user = factory(User::class, 1)->create();

        $this->delete('users/' . $user->getKey())
            ->seeJson([
                // quick way to force the key to be a string
                'id'      => '' . $user->getKey(),
                'deleted' => true,
            ]);
    }

    /**
     * @test
     */
    public function it_responds_with_error_when_nonexistent_user_is_deleted()
    {
        $user = factory(User::class, 1)->create();

        $this->delete('users/' . ($user->getKey() + 1))
            ->seeJson([
                'error' => 'User does not exist.',
            ]);
    }
}
