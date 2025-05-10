<?php
namespace Database\Seeders;

use App\Models\TimelineEvent;
use Illuminate\Database\Seeder;

class TimelineEventsSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'year' => 2023,
                'title' => 'توسعة برامج التمكين الاقتصادي',
                'description' => 'إطلاق 15 مشروعاً صغيراً للأسر المنتجة بتمويل تجاوز 750 ألف دينار، مع تدريب 200 أسرة على إدارة المشاريع الصغيرة.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2022,
                'title' => 'إنشاء مركز التدريب المهني',
                'description' => 'افتتاح مركز متخصص للتدريب المهني يقدم 12 برنامجاً تدريبياً في مجالات الحرف اليدوية والتقنية.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2021,
                'title' => 'مشروع السكن الآمن',
                'description' => 'توفير سكن لائق لـ 50 أسرة من الأسر المحتاجة ضمن مشروع متكامل يشمل التجهيزات الأساسية.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2020,
                'title' => 'جائزة التميز في العمل الخيري',
                'description' => 'فوز الجمعية بجائزة الملك عبدالله الثاني للتميز في العمل الخيري كأفضل مؤسسة تنموية لعام 2020.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2019,
                'title' => 'برنامج القروض الحسنة',
                'description' => 'إطلاق برنامج القروض الحسنة الذي ساعد 120 مستفيداً على بدء مشاريعهم الخاصة بدون فوائد.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2018,
                'title' => 'حملة العودة إلى المدرسة',
                'description' => 'تجهيز 3000 طالب وطالبة من الأسر المحتاجة بمستلزمات مدرسية كاملة.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2017,
                'title' => 'برنامج كفالة الأيتام',
                'description' => 'بدء برنامج كفالة الأيتام الذي يخدم أكثر من 500 طفل سنوياً بتكلفة تتجاوز مليون دينار.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2016,
                'title' => 'عيادة طبية متنقلة',
                'description' => 'تشغيل أول عيادة طبية متنقلة تخدم المناطق النائية وتقدم خدماتها مجاناً.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2015,
                'title' => 'إنشاء مركز الجمعية',
                'description' => 'افتتاح المقر الرئيسي للجمعية في العاصمة عمان بمساحة 2000 متر مربع.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2010,
                'title' => 'التأسيس',
                'description' => 'تأسيس جمعية عون الخيرية بترخيص من وزارة التنمية الاجتماعية برقم (1254).',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'year' => 2008,
                'title' => 'المبادرة التأسيسية',
                'description' => 'بدء العمل التطوعي الأولي من خلال مبادرات فردية قبل التأسيس الرسمي.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        TimelineEvent::insert($events);
    }
}
