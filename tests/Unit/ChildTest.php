<?php

namespace Tests\Unit;

use App\Models\Api\Child;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChildTest extends TestCase
{
    use RefreshDatabase;

    public function test_set_and_get_name()
    {
        $child = new Child();
        $child->setName("Child Name");

        $this->assertEquals("Child Name", $child->getName());
    }

    public function test_set_and_get_gender()
    {
        $child = new Child();
        $child->setGender("Female");

        $this->assertEquals("Female", $child->getGender());
    }

    public function test_set_and_get_age()
    {
        $child = new Child();
        $child->setAge(1.5);

        $this->assertEquals(1.5, $child->getAge());
    }

    public function test_set_and_get_parent()
    {
        $user = \App\Models\User::factory()->create();
        $child = \App\Models\Api\Child::factory()->create();
        $child->setParent($user->getId());

        $this->assertInstanceOf(\App\Models\User::class, $child->getParent());
    }

    public function test_child_has_parent()
    {
        $child = \App\Models\Api\Child::factory()->create();
        $this->assertInstanceOf(\App\Models\User::class, $child->parent);
    }
}
