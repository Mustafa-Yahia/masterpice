<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cause;

class CauseSeeder extends Seeder
{
    public function run()
    {
        // إضافة بعض البيانات الافتراضية
        Cause::create([
            'title' => 'تبرع لتوفير الغذاء الصحي',
            'description' => 'ساهم في توفير الطعام الصحي للمحتاجين.',
            'image' => 'education-poor-countries.jpg',
            'raised_amount' => 5000,
            'goal_amount' => 10000,
        ]);

        Cause::create([
            'title' => 'دعم التعليم للأطفال الفقراء',
            'description' => 'مساعدة الأطفال الفقراء في الحصول على التعليم.',
            'image' => 'education-poor-countries.jpg',
            'raised_amount' => 2000,
            'goal_amount' => 8000,
        ]);

        Cause::create([
            'title' => 'مساعدة المرضى المحتاجين',
            'description' => 'تبرع لمساعدة المرضى الذين يحتاجون إلى العلاج.',
            'image' => 'education-poor-countries.jpg',
            'raised_amount' => 3000,
            'goal_amount' => 7000,
        ]);


        $cause = Cause::create([
            'title' => 'حملة تبرع لمريض السرطان',
            'description' => 'تبرع لدعم مريض السرطان...',
            'image' => 'education-poor-countries.jpg',
            'goal_amount' => 10000,
            'raised_amount' => 5000,
            'end_time' => '2025-05-01 23:59:59', // مثال على وقت الانتهاء
        ]);

    }
}
