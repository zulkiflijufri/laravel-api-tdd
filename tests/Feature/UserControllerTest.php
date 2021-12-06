<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_show_all_users()
    {
        User::factory(10)->create();

        $response = $this->get(route('users.index'));

        $response->assertOk()
            ->assertJsonStructure(['data'])
            ->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_show_spesific_users()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user->id));

        $response->assertOk();
    }

    /** @test */
    public function it_add_new_users()
    {
        $response = $this->postJson(route('users.store'), [
            'name' => 'Zulkifli',
            'username' => 'zulkifli',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertEquals(true, $response['status']);
        $this->assertEquals('user created', $response['message']);

        $response->assertOk()
            ->assertJsonPath('data.attributes.name', 'Zulkifli');
    }

    /** @test */
    public function it_add_new_users_but_username_already_taken()
    {
        User::create([
            'name' => 'Zulkifli',
            'username' => 'zulkifli',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->postJson(route('users.store'), [
            'name' => 'Zulkifli',
            'username' => 'zulkifli',
            'email' => 'zulkifli@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertInvalid('username');
    }

     /** @test */
     public function it_add_new_users_but_email_already_taken()
     {
         User::create([
             'name' => 'Zul',
             'username' => 'zulkifli',
             'email' => 'zul@mail.com',
             'age' => 18,
             'password' => 'password',
             'password_confirmation' => 'password',
         ]);

         $response = $this->postJson(route('users.store'), [
             'name' => 'Zul',
             'username' => 'zul',
             'email' => 'zul@mail.com',
             'age' => 18,
             'password' => 'password',
             'password_confirmation' => 'password',
         ]);

         $response->assertInvalid('email');
     }

    /** @test */
    public function it_validate_add_new_users()
    {
        $response = $this->postJson(route('users.store'), [
            'name' => '',
            'username' => '',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertUnprocessable()
            ->assertInvalid(['name', 'username']);

    }

     /** @test */
     public function it_add_new_users_but_invalid_key()
     {
         $response = $this->postJson(route('users.store'), [
             'nama' => 'Zukifli', //name
             'username' => 'zulkifli',
             'email' => 'zul@mail.com',
             'usia' => 18, //age
             'password' => 'password',
             'password_confirmation' => 'password',
         ]);

         $response->assertUnprocessable()
            ->assertSessionMissing(['name', 'age']);
     }

    /** @test */
    public function it_add_new_users_but_password_confirmation_does_not_match()
    {
        $response = $this->postJson(route('users.store'), [
            'name' => 'Zulkifli',
            'username' => 'zulkifli',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'passwordxxx',
        ]);

        $response->assertInvalid([
            'password' => 'The password confirmation does not match.'
        ]);
    }

    /** @test */
    public function it_update_a_users()
    {
        $user = User::create([
            'name' => 'Zulkifli',
            'username' => 'zulkifli',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->putJson(route('users.update', $user->id), [
            'name' => 'Zulkifli Jufri',
            'username' => 'zulkifli',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertEquals(true, $response['status']);
        $this->assertEquals('user updated', $response['message']);

        $response->assertOk()
            ->assertJsonPath('data.attributes.name', 'Zulkifli Jufri');
    }

    /** @test */
    public function it_update_a_users_but_username_already_taken()
    {
        $user = User::factory()->create();

        User::create([
            'name' => 'Fahri',
            'username' => 'fahri',
            'email' => 'fahri@mail.com',
            'age' => 15,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->putJson(route('users.update', $user->id), [
            'name' => 'Zulkifli',
            'username' => 'fahri',
            'email' => 'zul@mail.com',
            'age' => 18,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertInvalid('username');
    }

     /** @test */
     public function it_update_a_users_but_email_already_taken()
     {
         $user = User::factory()->create();

         User::create([
             'name' => 'Fahri',
             'username' => 'fahri',
             'email' => 'fahri@mail.com',
             'age' => 15,
             'password' => 'password',
             'password_confirmation' => 'password',
         ]);

         $response = $this->putJson(route('users.update', $user->id), [
             'name' => 'Zulkifli',
             'username' => 'zulkifli',
             'email' => 'fahri@mail.com',
             'age' => 18,
             'password' => 'password',
             'password_confirmation' => 'password',
         ]);

         $response->assertInvalid('email');
     }

     /** @test */
     public function it_delete_users()
     {
         $user = User::factory()->create();

         $response = $this->deleteJson(route('users.destroy', $user->id));

         $response->assertOk();

         $this->assertEquals(true, $response['status']);
         $this->assertEquals('user deleted', $response['message']);
     }
}
