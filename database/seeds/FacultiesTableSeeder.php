<?php

use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
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
            $faculty = new \App\Models\Faculty();
            $faculty->name = $faker->name;
            $faculty->save();
        }
    }
}
