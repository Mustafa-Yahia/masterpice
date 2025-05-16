<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Cause;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot()
{
    View::composer('*', function ($view) {
        // عدد الحملات النشطة
        $activeCauses = Cause::where('end_date', '>=', now())
                            ->orWhereNull('end_date')
                            ->count();

        // عدد المستخدمين الكلي
        $totalUsers = User::count();

        // مشاركة المتغيرات مع جميع الصفحات
        $view->with([
            'activeCauses' => $activeCauses,
            'totalUsers' => $totalUsers
        ]);
    });
}
}
