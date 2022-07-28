<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/api/register', [
            "name" => fake()->name(),
            "email" => fake()->safeEmail(),
            "phone_number" => fake()->phoneNumber(),
            "password" => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 201,
        ]);
    }

    public function test_user_can_create_child()
    {
        Sanctum::actingAs(
            \App\Models\User::factory()->create(),
            ['*']
        );

        $response = $this->post('/api/user/children/create', [
            "name" => fake()->name(),
            "age" => fake()->numberBetween(1, 5),
            "gender" => "male"
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 201
        ]);
    }

    public function test_user_can_create_partner()
    {
        Sanctum::actingAs(
            \App\Models\User::factory()->create(),
            ['*']
        );

        $response = $this->post('/api/user/partner/create', [
            "name" => fake()->name(),
            "email" => fake()->safeEmail(),
            "phone_number" => fake()->phoneNumber(),
            "password" => "12345678",
            "password_confirmation" => "12345678",
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 201
        ]);
    }

    public function test_user_get_null_without_partner()
    {
        Sanctum::actingAs(
            \App\Models\User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/user/partner/show');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200,
            "data" => [
                "partner" => null
            ]
        ]);
    }

    public function test_user_get_his_partner()
    {
        $partner = \App\Models\User::factory()->create();
        $user = \App\Models\User::factory()->create();
        $user->setPartner($partner->getId());
        $user->save();

        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->get('/api/user/partner/show');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200,
        ]);

        $response->assertJsonMissing([
            "partner" => null
        ]);
    }

    public function test_user_get_empty_array_without_children()
    {
        $user = \App\Models\User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->get('/api/user/children/list', [
            "name" => fake()->name()
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200,
            "data" => [
                "children" => []
            ]
        ]);
    }

    public function test_user_get_children_array()
    {
        $user = \App\Models\User::factory()->create();
        $child = \App\Models\Api\Child::factory()->create();
        $child->setParent($user->getId());
        $child->save();

        Sanctum::actingAs($user, ['*']);

        $response = $this->get('/api/user/children/list', [
            "name" => fake()->name()
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200,
        ]);

        $response->assertJsonMissing([
            "data" => [
                "children" => []
            ]
        ]);
    }

    public function test_user_can_show_one_child()
    {
        $user = \App\Models\User::factory()->create();
        $child = \App\Models\Api\Child::factory()->create();
        $child->setParent($user->getId());
        $child->save();

        Sanctum::actingAs($user, ['*']);

        $response = $this->get('/api/user/children/' . $child->getId() . '/show', [
            "name" => fake()->name()
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200
        ]);
    }

    public function test_user_can_update_child()
    {
        $user = \App\Models\User::factory()->create();
        $child = \App\Models\Api\Child::factory()->create();
        $child->setParent($user->getId());
        $child->save();

        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/user/children/' . $child->getId() . '/edit', [
            "name" => fake()->name()
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200
        ]);
    }

    public function test_user_can_delete_child_he_created()
    {
        $user = \App\Models\User::factory()->create();
        $child = \App\Models\Api\Child::factory()->create();
        $child->setParent($user->getId());
        $child->save();

        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/user/children/' . $child->getId() . '/delete');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "status_code" => 200
        ]);
    }

    public function test_user_can_not_delete_child_not_created()
    {
        $user = \App\Models\User::factory()->create();
        $child = \App\Models\Api\Child::factory()->create();
        $child->setParent($user->getId());
        $child->save();

        Sanctum::actingAs(
            \App\Models\User::factory()->create(),
            ['*']
        );

        $response = $this->post('/api/user/children/' . $child->getId() . '/delete');

        $response->assertStatus(404);
        $response->assertJsonFragment([
            "success" => false,
            "status_code" => 404
        ]);
    }
}
