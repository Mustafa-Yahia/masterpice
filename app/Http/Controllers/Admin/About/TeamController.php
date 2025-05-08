<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all(); // جلب جميع أعضاء الفريق من قاعدة البيانات
        return view('admin.about.team.index', ['teams' => $teams]); // تمرير البيانات إلى الـ View
    }
}
