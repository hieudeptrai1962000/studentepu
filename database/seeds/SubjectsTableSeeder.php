<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
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
            $subject = new \App\Models\Subject();
            $subject->name = $faker->name;
            $subject->faculty_id = random_int(1,10);
            $subject->save();
        }
    }
}
