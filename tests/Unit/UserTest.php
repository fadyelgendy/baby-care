<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_and_set_name()
    {
        $user = new User();
        $user->setName("Test User");
        $this->assertEquals("Test User", $user->getName());
    }

    public function test_get_and_set_email()
    {
        $user = new User();
        $user->setEmail("test@email.com");
        $this->assertEquals("test@email.com", $user->getEmail());
    }

    public function test_get_and_set_phone_number()
    {
        $user = new User();
        $user->setPhoneNumber("01200625885");
        $this->assertEquals("01200625885", $user->getPhoneNumber());
    }

    public function test_get_and_set_parent()
    {
        $user = new User();
        $user->setPartner(null);
        $this->assertEquals(null, $user->getPartner());

        $partner = \App\Models\User::factory()->create();
        $user->setPartner($partner->getId());

        $this->assertInstanceOf(User::class, $user->getPartner());
    }

    public function test_user_has_children()
    {
        $user = \App\Models\User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->getChildren());
    }
}
