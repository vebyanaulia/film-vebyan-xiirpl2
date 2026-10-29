<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthCommentTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Film $film;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'user']);
        $profile = Profile::forceCreate([
            'umur' => 20,
            'bio' => 'test',
            'alamat' => 'test',
        ]);
        $genre = Genre::create(['name' => 'Action']);

        $this->film = Film::create([
            'title' => 'Film Test',
            'sinopsis' => 'Sinopsis film test.',
            'year' => 2026,
            'poster' => 'poster.jpg',
            'genre_id' => $genre->id,
        ]);

        $this->user = User::forceCreate([
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => 'rahasia123',
            'role_id' => $role->id,
            'profile_id' => $profile->id,
        ]);

        view()->share('genres', Genre::all());
    }

    public function test_guest_only_sees_login_prompt_on_movie_detail(): void
    {
        $this->get(route('movies.show', $this->film))
            ->assertOk()
            ->assertSee('Login untuk berkomentar')
            ->assertSee(route('login', ['redirect' => route('movies.show', $this->film)]), false)
            ->assertDontSee('name="comment"', false);
    }

    public function test_guest_cannot_store_comment(): void
    {
        $this->post(route('comments.store', $this->film), [
            'comment' => 'Komentar tanpa login',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseMissing('kritiks', [
            'comment' => 'Komentar tanpa login',
        ]);
    }

    public function test_user_can_login_with_hashed_password_and_start_session(): void
    {
        $this->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'rahasia123',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->user);
        $this->assertTrue(Hash::check('rahasia123', $this->user->password));
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $this->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'salah',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_store_comment_bound_to_their_account(): void
    {
        $this->actingAs($this->user)
            ->get(route('movies.show', $this->film))
            ->assertOk()
            ->assertDontSee('name="user_id"', false)
            ->assertDontSee('name="movie_id"', false)
            ->assertSee('name="comment"', false)
            ->assertSee('maxlength="500"', false)
            ->assertDontSee('placeholder="Name"', false)
            ->assertDontSee('placeholder="Phone"', false);

        $this->actingAs($this->user)
            ->post(route('comments.store', $this->film), [
                'comment' => 'Komentar dari user login',
                'user_id' => 9999,
                'movie_id' => 9999,
            ])
            ->assertRedirect(route('movies.show', $this->film));

        $this->assertDatabaseHas('kritiks', [
            'comment' => 'Komentar dari user login',
            'film_id' => $this->film->id,
            'user_id' => $this->user->id,
        ]);

        $this->assertDatabaseMissing('kritiks', [
            'user_id' => 9999,
        ]);

        $this->get(route('movies.show', $this->film))
            ->assertSee('Budi')
            ->assertDontSee('user_id', false);
    }

    public function test_comment_is_rejected_when_longer_than_500_characters(): void
    {
        $this->actingAs($this->user)
            ->post(route('comments.store', $this->film), [
                'comment' => str_repeat('x', 501),
            ])
            ->assertSessionHasErrors('comment');
    }

    public function test_login_returns_user_to_the_film_page_after_comment_prompt(): void
    {
        $this->get(route('login', ['redirect' => route('movies.show', $this->film)]));

        $this->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'rahasia123',
        ])->assertRedirect(route('movies.show', $this->film));
    }
}
