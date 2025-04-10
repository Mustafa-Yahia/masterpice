<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationCategory;

class DonationCategorySeeder extends Seeder
{
    public function run()
{
    DonationCategory::create([
        'title' => 'كفالة الأسر',
        'description' => 'ساعد الأسر الفقيرة بتوفير الدعم المالي والغذائي.',
        'image' => 'family.jpeg',
        'slug' => 'family-support'
    ]);

    DonationCategory::create([
        'title' => 'الطرود الغذائية الشهرية',
        'description' => 'تبرع بطرود غذائية تكفي لعائلات محتاجة لمدة شهر كامل.',
        'image' => 'turwd.jpeg',
        'slug' => 'food-packages'
    ]);
    DonationCategory::create([
        'title' => 'زكاة الفطر',
        'description' => 'تأدية زكاة الفطر للأسر المحتاجة وفقًا للشريعة الإسلامية.',
        'image' => 'zqatk.jpg',
        'slug' => 'zakat-fitr'
    ]);

    DonationCategory::create([
        'title' => 'كفارة رمضان',
        'description' => 'ساعد في تقديم كفارة رمضان لمن لا يستطيع الصيام.',
        'image' => 'kfsyamm.png',
        'slug' => 'kaffara-ramadan'
    ]);

    DonationCategory::create([
        'title' => 'وجبات إفطار صائم',
        'description' => 'ساهم في توفير وجبات إفطار صائم للفقراء خلال شهر رمضان.',
        'image' => 'aftarsaym.jpg',
        'slug' => 'iftar-meals'
    ]);

    DonationCategory::create([
        'title' => 'الصدقات العامة',
        'description' => 'تبرع للمحتاجين من خلال الصدقات العامة والمساعدات الإنسانية.',
        'image' => 'sadaqa.jpg',
        'slug' => 'general-donations'
    ]);
    DonationCategory::create([
        'title' => 'الصدقات العامة',
        'description' => 'تبرع للمحتاجين من خلال الصدقات العامة والمساعدات الإنسانية.',
        'image' => 'sadaqa.jpg',
        'slug' => 'general-donations'
    ]);
    DonationCategory::create([
        'title' => 'الصدقات العامة',
        'description' => 'تبرع للمحتاجين من خلال الصدقات العامة والمساعدات الإنسانية.',
        'image' => 'sadaqa.jpg',
        'slug' => 'general-donations'
    ]);
    DonationCategory::create([
        'title' => 'الصدقات العامة',
        'description' => 'تبرع للمحتاجين من خلال الصدقات العامة والمساعدات الإنسانية.',
        'image' => 'sadaqa.jpg',
        'slug' => 'general-donations'
    ]);
    DonationCategory::create([
        'title' => 'الصدقات العامة',
        'description' => 'تبرع للمحتاجين من خلال الصدقات العامة والمساعدات الإنسانية.',
        'image' => 'sadaqa.jpg',
        'slug' => 'general-donations'
    ]);
}

}
