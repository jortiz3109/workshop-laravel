<?php

namespace Tests\Feature;

use App\City;
use App\Collaborator;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollaboratorsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUnauthenticatedUserCannotAccessToCollaboratorsList()
    {
        $response = $this->get(route('collaborators.index'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthenticatedUserHasAccessToCollaboratorsList()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('collaborators.index'))->assertSuccessful();

        $this->assertAuthenticatedAs($user);
    }

    public function testCollaboratorsListContainsAListOfCollaborators()
    {
        $user = factory(User::class)->create();
        $collaborators = factory(Collaborator::class, 5)->create();

        $response  = $this->actingAs($user)->get(route('collaborators.index'));

        $response->assertSuccessful();
        $response->assertViewHas('collaborators');
        $response->assertViewIs('collaborators.index');
        $response->assertSeeText($collaborators->shuffle()->first()->name);
    }

    public function testUnauthenticatedUserCannotCreateACollaborator()
    {
        $role = factory(Role::class)->create();
        $city = factory(City::class)->create();

        $this->post(route('collaborators.store'), [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
            'city' => $city->id,
            'role' => $role->id,
        ])
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('collaborators', [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
        ]);
    }

    public function testACollaboratorCanBeCreated()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $city = factory(City::class)->create();

        $this->actingAs($user)->post(route('collaborators.store'), [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
            'city' => $city->id,
            'role' => $role->id,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('collaborators', [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
        ]);
    }

    public function testUnauthenticatedUserCannotUpdateACollaborator()
    {
        $collaborator = factory(Collaborator::class)->create();

        $this->put(route('collaborators.update', $collaborator), [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
            'city' => $collaborator->city_id,
            'role' => $collaborator->role_id,
        ])
        ->assertRedirect(route('login'));

        $this->assertDatabaseHas('collaborators', [
            'name' => $collaborator->name,
            'email' => $collaborator->email,
        ]);
    }


    public function testACollaboratorCanBeUpdated()
    {
        $user = factory(User::class)->create();
        $collaborator = factory(Collaborator::class)->create();

        $this->actingAs($user)->put(route('collaborators.update', $collaborator), [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
            'city' => $collaborator->city_id,
            'role' => $collaborator->role_id,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('collaborators', [
            'name' => 'Test Collaborator Name',
            'email' => 'test@email.com',
        ]);
    }

    public function testUnauthenticatedUserCannotDeleteACollaborator()
    {
        $collaborator = factory(Collaborator::class)->create();

        $this->delete(route('collaborators.destroy', $collaborator))
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('collaborators', [
            'name' => $collaborator->name,
            'email' => $collaborator->email,
        ]);
    }

    public function testACollaboratorCanBeDeleted()
    {
        $user = factory(User::class)->create();
        $collaborator = factory(Collaborator::class)->create();

        $this->actingAs($user)->delete(route('collaborators.destroy', $collaborator))
            ->assertRedirect(route('collaborators.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('collaborators', [
           'name' => $collaborator->name,
            'email' => $collaborator->email,
        ]);
    }

    public function testCanBeDetailsOfACollaborator()
    {
        $user = factory(User::class)->create();
        $collaborator = factory(Collaborator::class)->create();

        $response = $this->actingAs($user)->get(route('collaborators.show', $collaborator));

        $response->assertSuccessful();
        $response->assertSeeText($collaborator->name);
        $response->assertSeeText($collaborator->email);
        $response->assertSeeText($collaborator->city->name);
        $response->assertSeeText($collaborator->role->name);
    }
}
