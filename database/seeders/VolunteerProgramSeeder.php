<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VolunteerProgram;

class VolunteerProgramSeeder extends Seeder
{
    public function run()
    {
        $programs = [
            ['name' => 'برنامج الإطعام اليومي'],
            ['name' => 'برنامج دعم الأسر المحتاجة'],
            ['name' => 'برنامج رعاية الأيتام'],
            ['name' => 'برنامج التوعية المجتمعية']
        ];

        VolunteerProgram::insert($programs);
    }
}
