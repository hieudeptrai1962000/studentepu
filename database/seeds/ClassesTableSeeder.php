<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            $faker = \Faker\Factory::create('vi_VN');
            $class = new \App\Models\ClassModel();
            $class->name = $faker->name;
            $class->faculty_id = random_int(1,10);
            $class->save();
        }
    }
}
