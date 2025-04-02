<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use Illuminate\Http\Request;

class CauseController extends Controller
{
    public function index()
    {
        $causes = Cause::all(); // جلب جميع الأسباب من قاعدة البيانات
        return view('index', compact('causes'));
    }

    public function show($id)
    {
        $cause = Cause::findOrFail($id);
        return view('cause.show', compact('cause'));
    }
}
