<?php

use Illuminate\Database\Seeder;

class MarksTableSeeder extends Seeder
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
            $mark = new \App\Models\Mark();
            $mark->mark = random_int(0,10);
            $mark->subject_id = random_int(1,10);
            $mark->student_id = random_int(1,10);
            $mark->save();
        }
    }
}
