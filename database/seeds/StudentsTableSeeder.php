<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');
        $student = new \App\Models\Student();
        $student->phone_number = $faker->phoneNumber;
        $student->name = $faker->name;
        $student->class_id = random_int(1,10);
        $student->birthday = $faker->date();
        $student->gender = $faker->randomElement(['male','female']);
        $student->save();
    }
}
