<?php

namespace App\Http\Controllers\about; // تأكد أن النيمسبيس يتضمن المجلد

use App\Http\Controllers\Controller;
use App\Models\Team; // استدعاء نموذج Team

class AboutController extends Controller
{
    public function index()
    {
        $teams = Team::all(); // جلب كل أعضاء الفريق
        return view('about', compact('teams')); // تمرير البيانات إلى العرض
    }
}
