<?php
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
        $user = factory(User::class, 1)->create();

        $this->delete('users/' . $user->getKey())
            ->seeJson([
                // Quick way to force the key to be a string, as we’re not using
                // a transformer for the api responses.
                'id'      => '' . $user->getKey(),
                'deleted' => true,
            ]);
    }

    /**
     * @test
     */
    public function it_responds_with_error_when_nonexistent_user_is_deleted()
    {
        $this->delete('users/1')
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

        $this->get('users/' . $user->getKey())
            ->seeJson([
                'id'    => '' . $user->getKey(),
                'name'  => $user->name,
                'email' => $user->email,
            ]);
    }
}
