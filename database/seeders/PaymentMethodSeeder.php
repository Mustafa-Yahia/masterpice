<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\PaymentMethod::create([
            'method_name' => 'بطاقة ائتمان',
            'description' => 'الدفع باستخدام البطاقة الائتمانية أو الخصم المباشر'
        ]);

        \App\Models\PaymentMethod::create([
            'method_name' => 'تحويل بنكي',
            'description' => 'التحويل المباشر إلى حساب بنكي معتمد'
        ]);

        \App\Models\PaymentMethod::create([
            'method_name' => 'زين كاش / أورانج كاش',
            'description' => 'الدفع باستخدام المحافظ الإلكترونية في الأردن'
        ]);
    }

}
