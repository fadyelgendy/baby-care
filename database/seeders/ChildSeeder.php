<?php

namespace Database\Seeders;

use App\Models\Api\Child;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $child = new Child();
            $child->setName("child name " . $i)
                ->setGender($i % 2 == 0 ? Child::FEMALE : Child::MALE)
                ->setAge(floatval($i / $i + 1))
                ->setParent(rand(1,2))
                ->save();
        }
    }
}
