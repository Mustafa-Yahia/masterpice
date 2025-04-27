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
            'description' => 'مساعدة الأطفال الفقراء في الحصول على التعليم في مناطق المملكة المختلفة.',
            'image' => 'education-poor-countries.jpg',
            'raised_amount' => 2500,
            'goal_amount' => 10000,
            'end_time' => '2025-06-10',
            'category' => 'تعليم',
            'location' => 'عمان، الأردن',
            'additional_details' => 'حملة تهدف لتمويل تعليم الأطفال في المدارس الحكومية.',
            'responsible_person_name' => 'أحمد العلي', // Added responsible person name
            'responsible_person_email' => 'ahmed.alali@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'مساعدة المرضى المحتاجين',
            'description' => 'تبرع لمساعدة المرضى الذين يحتاجون إلى العلاج، خاصة في المستشفيات الحكومية.',
            'image' => 'medical-aid.jpeg',
            'raised_amount' => 5000,
            'goal_amount' => 12000,
            'end_time' => '2025-05-15',
            'category' => 'صحة',
            'location' => 'إربد، الأردن',
            'additional_details' => 'حملة تهدف لدعم المرضى الذين لا يستطيعون دفع تكاليف العلاج.',
            'responsible_person_name' => 'سامي محمد', // Added responsible person name
            'responsible_person_email' => 'sami.mohammad@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'حملة تبرع لمريض السرطان',
            'description' => 'تبرع لدعم مرضى السرطان في الأردن لتوفير العلاج والرعاية الصحية.',
            'image' => 'cancer-support.png',
            'raised_amount' => 8000,
            'goal_amount' => 20000,
            'end_time' => '2025-07-20',
            'category' => 'صحة',
            'location' => 'العاصمة عمان، الأردن',
            'additional_details' => 'تهدف الحملة لدعم المرضى في مستشفى الملك حسين.',
            'responsible_person_name' => 'فاطمة الزهراء', // Added responsible person name
            'responsible_person_email' => 'fatima.zahra@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'إغاثة المتضررين من الزلازل',
            'description' => 'تبرع لدعم ضحايا الزلازل في المناطق المتضررة بالمملكة الأردنية الهاشمية.',
            'image' => 'earthquake-relief.jpg',
            'raised_amount' => 12000,
            'goal_amount' => 30000,
            'end_time' => '2025-06-30',
            'category' => 'إغاثة',
            'location' => 'مناطق الزلازل في الأردن',
            'additional_details' => 'مساعدة متضرري الزلازل وتوفير مواد إغاثة.',
            'responsible_person_name' => 'سليم حماد', // Added responsible person name
            'responsible_person_email' => 'saleem.hamad@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'دعم مشروعات المياه النظيفة',
            'description' => 'تبرع لتوفير المياه النظيفة للمجتمعات الفقيرة في المناطق الجبلية.',
            'image' => 'clean-water-project.jpg',
            'raised_amount' => 9000,
            'goal_amount' => 20000,
            'end_time' => '2025-09-01',
            'category' => 'بيئة',
            'location' => 'الطفيلة، الأردن',
            'additional_details' => 'حملة تهدف لتوفير المياه النظيفة في المناطق الجبلية والنائية.',
            'responsible_person_name' => 'يوسف أحمد', // Added responsible person name
            'responsible_person_email' => 'yousef.ahmed@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'مساعدة اللاجئين السوريين',
            'description' => 'تبرع لدعم اللاجئين السوريين في المخيمات في الأردن وتوفير احتياجاتهم الأساسية.',
            'image' => 'syrian-refugees.jpg',
            'raised_amount' => 4000,
            'goal_amount' => 15000,
            'end_time' => '2025-08-10',
            'category' => 'إغاثة',
            'location' => 'مخيمات اللاجئين في الأردن',
            'additional_details' => 'توفير الطعام والمأوى للاجئين السوريين في مخيمات اللاجئين.',
            'responsible_person_name' => 'حسين المصري', // Added responsible person name
            'responsible_person_email' => 'hussein.masri@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'توفير الملابس الشتوية للمحتاجين',
            'description' => 'تبرع لتوفير ملابس شتوية للأطفال والعائلات الفقيرة في الأردن خلال فصل الشتاء.',
            'image' => 'winter-clothes.jpg',
            'raised_amount' => 2000,
            'goal_amount' => 7000,
            'end_time' => '2025-12-01',
            'category' => 'إغاثة',
            'location' => 'عمان، الأردن',
            'additional_details' => 'حملة تهدف لجمع الملابس الشتوية وتوزيعها على المحتاجين.',
            'responsible_person_name' => 'منى عبد الله', // Added responsible person name
            'responsible_person_email' => 'mona.abdallah@example.com', // Added responsible person email
        ]);

        Cause::create([
            'title' => 'مساعدة الفقراء في رمضان',
            'description' => 'تبرع لتوفير المواد الغذائية للمحتاجين في شهر رمضان المبارك.',
            'image' => 'ramadan-aid.jpg',
            'raised_amount' => 15000,
            'goal_amount' => 25000,
            'end_time' => '2025-04-15',
            'category' => 'إغاثة',
            'location' => 'جميع محافظات الأردن',
            'additional_details' => 'حملة تهدف لجمع التبرعات وتوزيع المواد الغذائية على الأسر المحتاجة.',
            'responsible_person_name' => 'سارة خالد', // Added responsible person name
            'responsible_person_email' => 'sara.khaled@example.com', // Added responsible person email
        ]);
    }
}
