<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use Illuminate\Http\Request;

class CauseController extends Controller
{
    public function index()
    {
        $causes = Cause::paginate(6);
        return view('cause.index', compact('causes'));
    }

    public function cause(Request $request)
    {
        $query = Cause::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('goal_amount')) {
            $query->where('goal_amount', '>=', $request->goal_amount);
        }

        if ($request->filled('end_time')) {
            $query->whereDate('end_time', '<=', $request->end_time);
        }

        $causes = $query->paginate(9);

        $categories = Cause::select('category')->distinct()->pluck('category');

        if ($request->ajax()) {
            return view('cause.partials.causes-list', compact('causes'))->render();
        }

        return view('cause.cause', compact('causes', 'categories'));
    }

    public function show($id)
    {
        $cause = Cause::findOrFail($id);
        return view('cause.show', compact('cause'));
    }

    public function donate($id)
    {
        $cause = Cause::findOrFail($id);
        return view('donate', compact('cause'));
    }


}
