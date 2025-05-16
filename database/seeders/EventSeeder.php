<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            // 1. حدث ماضٍ
            [
                'title' => 'حملة شتاء دافئ في الطفيلة',
                'description' => 'توزيع دفايات وبطانيات على الأسر الفقيرة لمواجهة البرد القارس.',
                'date' => '2024-12-15',
                'time' => '10:00:00',
                'location' => 'الطفيلة',
                'image' => 'warm_winter.jpg',
                'location_url' => 'https://maps.google.com/?q=30.833,35.616',
                'mission' => 'توفير التدفئة والملابس الشتوية للأسر المتضررة من البرد.',
                'latitude' => 30.833,
                'longitude' => 35.616,
                'mission_point_1' => 'توزيع 300 بطانية.',
                'mission_point_2' => 'تقديم 100 دفاية.',
                'mission_point_3' => 'تغطية احتياجات الأطفال من الملابس الشتوية.'
            ],
            // 2. حدث ماضٍ
            [
                'title' => 'كفالة أيتام في الزرقاء',
                'description' => 'رعاية شاملة لـ10 أيتام تشمل التعليم والصحة والغذاء والسكن لمدة عام.',
                'date' => '2025-03-01',
                'time' => '09:00:00',
                'location' => 'الزرقاء',
                'image' => 'orphans_support.jpg',
                'location_url' => 'https://maps.google.com/?q=32.07275,36.08796',
                'mission' => 'دعم الأيتام مادياً ومعنوياً لضمان حياة كريمة.',
                'latitude' => 32.07275,
                'longitude' => 36.08796,
                'mission_point_1' => 'توفير التعليم والصحة.',
                'mission_point_2' => 'تقديم الغذاء والسكن.',
                'mission_point_3' => 'زيارات دورية للأيتام ومتابعة حالتهم.'
            ],
            // 3. حدث بتاريخ اليوم
            [
                'title' => 'اليوم الطبي المجاني في مادبا',
                'description' => 'عيادة طبية متنقلة تقدم خدمات مجانية في القرى النائية بمادبا.',
                'date' => date('Y-m-d'), // اليوم
                'time' => '08:30:00',
                'location' => 'مادبا',
                'image' => 'mobile_clinic.jpg',
                'location_url' => 'https://maps.google.com/?q=31.715,35.793',
                'mission' => 'الوصول بالخدمات الصحية للمناطق المحرومة.',
                'latitude' => 31.715,
                'longitude' => 35.793,
                'mission_point_1' => 'فحص مجاني لـ200 مريض.',
                'mission_point_2' => 'توزيع الأدوية الأساسية.',
                'mission_point_3' => 'توعية صحية للمجتمع المحلي.'
            ],
            // 4. حدث في المستقبل القريب
            [
                'title' => 'توزيع مياه نظيفة في الكورة',
                'description' => 'توفير مياه شرب نظيفة لـ500 أسرة في قرى لواء الكورة.',
                'date' => '2025-06-10',
                'time' => '11:00:00',
                'location' => 'إربد - الكورة',
                'image' => 'clean_water.jpg',
                'location_url' => 'https://maps.google.com/?q=32.4775,35.6556',
                'mission' => 'تحسين صحة الأسر الريفية من خلال مياه نظيفة.',
                'latitude' => 32.4775,
                'longitude' => 35.6556,
                'mission_point_1' => 'تركيب خزانات مياه نظيفة.',
                'mission_point_2' => 'توزيع فلاتر مياه.',
                'mission_point_3' => 'توعية حول النظافة الشخصية والمياه.'
            ],
            // 5. حدث مستقبلي
            [
                'title' => 'مركز تعليمي للأطفال المحتاجين',
                'description' => 'إنشاء مركز لتعليم الأطفال في القرى الفقيرة.',
                'date' => '2025-07-01',
                'time' => '09:00:00',
                'location' => 'المفرق',
                'image' => 'education_center.jpg',
                'location_url' => 'https://maps.google.com/?q=32.34289,36.20804',
                'mission' => 'توفير بيئة تعليمية للأطفال المحرومين.',
                'latitude' => 32.34289,
                'longitude' => 36.20804,
                'mission_point_1' => 'تجهيز المركز بالمقاعد والأدوات.',
                'mission_point_2' => 'توفير مناهج تعليمية أساسية.',
                'mission_point_3' => 'تدريب المعلمين من المجتمع المحلي.'
            ],
            // 6. حدث مستقبلي
            [
                'title' => 'تمويل مشاريع صغيرة للأسر المنتجة',
                'description' => 'دعم 30 أسرة منتجة بمشاريع صغيرة لتحسين دخلهم.',
                'date' => '2025-07-20',
                'time' => '10:30:00',
                'location' => 'جرش',
                'image' => 'small_projects.jpg',
                'location_url' => 'https://maps.google.com/?q=32.2769,35.8947',
                'mission' => 'تمكين الأسر اقتصادياً عبر المشاريع الصغيرة.',
                'latitude' => 32.2769,
                'longitude' => 35.8947,
                'mission_point_1' => 'تمويل مشاريع زراعية ومنزلية.',
                'mission_point_2' => 'تدريب على إدارة المشاريع.',
                'mission_point_3' => 'متابعة دورية لضمان الاستدامة.'
            ],
            // 7. حدث مستقبلي
            [
                'title' => 'مساعدة طالب جامعي على سداد رسوم الإكمال',
                'description' => 'دعم طالب متفوق لإكمال دراسته الجامعية في تخصص هندسي.',
                'date' => '2025-08-05',
                'time' => '12:00:00',
                'location' => 'عمان',
                'image' => 'student_aid.jpg',
                'location_url' => 'https://maps.google.com/?q=31.95522,35.94503',
                'mission' => 'دعم التعليم العالي للطلبة المتفوقين ذوي الدخل المحدود.',
                'latitude' => 31.95522,
                'longitude' => 35.94503,
                'mission_point_1' => 'سداد الأقساط المتبقية.',
                'mission_point_2' => 'توفير لابتوب وكتب دراسية.',
                'mission_point_3' => 'متابعة أكاديمية حتى التخرج.'
            ],
            // 8. حدث مستقبلي
            [
                'title' => 'بناء وحدات سكنية مؤقتة للنازحين',
                'description' => 'توفير سكن مؤقت للأسر النازحة بسبب الظروف الاقتصادية.',
                'date' => '2025-09-01',
                'time' => '08:00:00',
                'location' => 'معان',
                'image' => 'shelter_units.jpg',
                'location_url' => 'https://maps.google.com/?q=30.195,35.736',
                'mission' => 'تأمين حياة كريمة مؤقتة للأسر النازحة.',
                'latitude' => 30.195,
                'longitude' => 35.736,
                'mission_point_1' => 'بناء 20 وحدة سكنية خشبية.',
                'mission_point_2' => 'توفير الكهرباء والمياه.',
                'mission_point_3' => 'توزيع مفروشات أساسية.'
            ],
        ]);
    }
}
