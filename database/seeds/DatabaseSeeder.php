<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(FacultiesTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();
        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(ClassesTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();

        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(StudentsTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();

        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(SubjectsTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();

        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(MarksTableSeeder::class);

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
