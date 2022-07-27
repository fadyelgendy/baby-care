<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->setName("User One")
            ->setEmail("email1@test.com")
            ->setPassword("12345678")
            ->setPhoneNumber("01200625881")
            ->setPartner(null)
            ->save();

        $user2 = new User();
        $user2->setName("User two")
            ->setEmail("email2@test.com")
            ->setPassword("12345678")
            ->setPhoneNumber("01200625882")
            ->setPartner($user1->getId())
            ->save();
    }
}
