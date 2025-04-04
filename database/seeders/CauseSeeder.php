<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cause;

class CauseSeeder extends Seeder
{
    public function run()
    {


        Cause::create([
            'title' => 'دعم التعليم للأطفال الفقراء',
            'description' => 'مساعدة الأطفال الفقراء في الحصول على التعليم.',
            'image' => 'education-poor-countries.jpg',
            'raised_amount' => 2000,
            'goal_amount' => 8000,
            'end_time' => '2025-04-10',
        ]);

        Cause::create([
            'title' => 'مساعدة المرضى المحتاجين',
            'description' => 'تبرع لمساعدة المرضى الذين يحتاجون إلى العلاج.',
            'image' => 'education-poor-countries.jpg',
            'raised_amount' => 3000,
            'goal_amount' => 7000,
            'end_time' => '2025-04-05',
        ]);

        Cause::create([
            'title' => 'حملة تبرع لمريض السرطان',
            'description' => 'تبرع لدعم مريض السرطان...',
            'image' => 'canceer.jpg',
            'goal_amount' => 10000,
            'raised_amount' => 5000,
            'end_time' => '2025-04-03',
        ]);

        Cause::create([
            'title' => 'إغاثة المتضررين من الزلازل',
            'description' => 'تبرع لدعم ضحايا الزلازل في المناطق المتضررة.',
            'image' => 'earthquake-relief.jpg',
            'raised_amount' => 10000,
            'goal_amount' => 15000,
            'end_time' => '2025-04-12',
        ]);

        Cause::create([
            'title' => 'دعم مشروعات المياه النظيفة',
            'description' => 'تبرع لتوفير المياه النظيفة للمجتمعات الفقيرة.',
            'image' => 'clean-water-project.jpg',
            'raised_amount' => 7000,
            'goal_amount' => 15000,
            'end_time' => '2025-04-07',
        ]);

        Cause::create([
            'title' => 'مساعدة اللاجئين السوريين',
            'description' => 'تبرع لدعم اللاجئين السوريين في المخيمات.',
            'image' => 'syrian-refugees.jpg',
            'raised_amount' => 2000,
            'goal_amount' => 6000,
            'end_time' => '2025-04-15',
        ]);

        Cause::create([
            'title' => 'توفير الملابس الشتوية للمحتاجين',
            'description' => 'تبرع لتوفير ملابس شتوية للأطفال والعائلات الفقيرة.',
            'image' => 'Winter_Web.jpg',
            'raised_amount' => 3000,
            'goal_amount' => 5000,
            'end_time' => '2025-04-08',
        ]);

        Cause::create([
            'title' => 'مساعدة الفقراء في رمضان',
            'description' => 'تبرع لتوفير المواد الغذائية للمحتاجين في رمضان.',
            'image' => 'ramadan-aid.jpg',
            'raised_amount' => 10000,
            'goal_amount' => 20000,
            'end_time' => '2025-04-20',
        ]);
    }
}
