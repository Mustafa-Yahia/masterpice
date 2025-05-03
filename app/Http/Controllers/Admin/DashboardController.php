<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donation;
use App\Models\Cause;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalDonations = Donation::sum('amount');
        $donationCount = Donation::count();
        $activeCauses = Cause::where('end_date', '>=', now())->orWhereNull('end_date')->count();

        // الحصول على التبرعات الشهرية للسنة الحالية
        $monthlyDonations = Donation::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // تعبئة البيانات لجميع الأشهر
        $donationsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $donationsData[] = $monthlyDonations[$i] ?? 0;
        }

        // توزيع التبرعات حسب الفئة
        $donationsByCategory = Cause::select(
                'category',
                DB::raw('SUM(raised_amount) as total')
            )
            ->groupBy('category')
            ->get()
            ->pluck('total', 'category')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDonations',
            'donationCount',
            'activeCauses',
            'donationsData',
            'donationsByCategory'
        ));
    }
    
}
// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use App\Models\Donation;
// use App\Models\Cause; // تأكد من استيراد نموذج Cause
// use Carbon\Carbon; // نستخدم Carbon للتعامل مع التواريخ

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $totalUsers = User::count();
//         $totalDonations = Donation::sum('amount');
//         $donationCount = Donation::count();

//         // حساب الحملات النشطة (التي لم ينتهي تاريخها بعد)
//         $activeCauses = Cause::where(function($query) {
//             $query->where('end_date', '>=', Carbon::now())
//                   ->orWhereNull('end_date');
//         })->count();

//         return view('admin.dashboard', compact(
//             'totalUsers',
//             'totalDonations',
//             'donationCount',
//             'activeCauses' // إضافة المتغير الجديد
//         ));
//     }
// }
