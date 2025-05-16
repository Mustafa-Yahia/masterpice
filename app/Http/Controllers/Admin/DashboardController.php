<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donation;
use App\Models\Cause;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // الإحصائيات الأساسية مع معالجة الأخطاء
            $totalUsers = User::count();
            $totalDonations = Donation::sum('amount') ?? 0;
            $donationCount = Donation::count();

            $activeCauses = Cause::where(function($query) {
                $query->where('end_date', '>=', now())
                      ->orWhereNull('end_date');
            })->count();

            // التبرعات الشهرية للسنة الحالية
            $monthlyDonations = Donation::query()
                ->select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('SUM(amount) as total')
                )
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            $donationsData = array_map(function($month) use ($monthlyDonations) {
                return $monthlyDonations[$month] ?? 0;
            }, range(1, 12));

            // توزيع التبرعات حسب الفئة
            $donationsByCategory = Cause::query()
                ->select('category', DB::raw('COALESCE(SUM(raised_amount), 0) as total'))
                ->groupBy('category')
                ->get()
                ->pluck('total', 'category')
                ->toArray();

            // بيانات المخطط الدائري للحملات
            $campaignDonations = Cause::query()
                ->withSum(['donations' => function($query) {
                    $query->whereNotNull('cause_id');
                }], 'amount')
                ->having('donations_sum_amount', '>', 0)
                ->orderByDesc('donations_sum_amount')
                ->take(5)
                ->get()
                ->map(function ($cause, $index) {
                    $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];
                    return [
                        'name' => $cause->title ?? 'حملة غير معروفة',
                        'amount' => $cause->donations_sum_amount ?? 0,
                        'color' => $colors[$index % count($colors)] ?? '#cccccc'
                    ];
                });

            // أحدث التبرعات
            $recentDonations = Donation::query()
                ->with([
                    'user' => function($query) {
                        $query->withDefault([
                            'name' => 'مستخدم غير معروف'
                        ]);
                    },
                    'cause' => function($query) {
                        $query->withDefault([
                            'title' => 'حملة غير معروفة'
                        ]);
                    }
                ])
                ->latest()
                ->take(10)
                ->get();

            // بيانات تقدم الحملات (المضافة حديثاً)
            $campaigns = Cause::select(['id', 'title', 'goal_amount', 'end_date', 'created_at'])
                ->withSum('donations', 'amount')
                ->orderByDesc('donations_sum_amount')
                ->take(5)
                ->get()
                ->map(function ($cause) {
                    $cause->raised_amount = $cause->donations_sum_amount ?? 0;
                    return $cause;
                });

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalDonations',
                'donationCount',
                'activeCauses',
                'donationsData',
                'donationsByCategory',
                'campaignDonations',
                'recentDonations',
                'campaigns' // المتغير المضاف
            ));

        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());

            // قيم افتراضية في حالة حدوث خطأ
            return view('admin.dashboard', [
                'totalUsers' => 0,
                'totalDonations' => 0,
                'donationCount' => 0,
                'activeCauses' => 0,
                'donationsData' => array_fill(0, 12, 0),
                'donationsByCategory' => [],
                'campaignDonations' => [],
                'recentDonations' => collect(),
                'campaigns' => collect() // القيمة الافتراضية للمتغير المضاف
            ]);
        }
    }

    public function getChartData()
    {
        $campaignDonations = Cause::with('donations')
            ->active()
            ->get()
            ->map(function($cause) {
                return [
                    'name' => $cause->title,
                    'amount' => $cause->donations->sum('amount'),
                    'color' => $this->getRandomColor()
                ];
            });

        return response()->json([
            'labels' => $campaignDonations->pluck('name')->toArray(),
            'data' => $campaignDonations->pluck('amount')->toArray(),
            'colors' => $campaignDonations->pluck('color')->toArray()
        ]);
    }

    private function getRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
