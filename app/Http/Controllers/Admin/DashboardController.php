<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count(); // عدد المستخدمين
        $totalDonations = Donation::sum('amount'); // مجموع التبرعات
        $donationCount = Donation::count(); // عدد التبرعات

        return view('admin.dashboard', compact('totalUsers', 'totalDonations', 'donationCount'));
    }
}
