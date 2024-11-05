<?php

namespace Database\Seeders;

use App\Models\Courses;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Schoolcareers;
use App\Models\courseyears;
use App\Models\groups;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void 
     */
    public function run(): void
    {
        $this->call([
            CourseyearsSeeder::class,
            CoursesSeeder::class,
            GroupsSeeder::class,
            StudentSeeder::class,
 
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin.admin@admin.com',
        ]);

        courseyears::factory()->count(10)->create();
        Courses::factory()->count(10)->create();
        groups::factory()->count(10)->create();
        Student::factory()->count(10)->create();
        Schoolcareers::factory()->count(10)->create();
    }
}
