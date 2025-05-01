<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cause;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminCauseController extends Controller
{
    /**
     * عرض جميع الحملات.
     */
    public function index(Request $request)
    {
        $query = Cause::query();

        // فلتر البحث العام
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        // فلتر نطاق المبلغ
        if ($request->has('amount_range')) {
            $range = $request->amount_range;
            if ($range == '0-1000') {
                $query->whereBetween('raised_amount', [0, 1000]);
            } elseif ($range == '1000-5000') {
                $query->whereBetween('raised_amount', [1000, 5000]);
            } elseif ($range == '5000-10000') {
                $query->whereBetween('raised_amount', [5000, 10000]);
            } elseif ($range == '10000+') {
                $query->where('raised_amount', '>', 10000);
            }
        }

        // فلتر حالة الحملة (الجزء المعدل)
        if ($request->has('status')) {
            $status = $request->status;
            $now = now()->format('Y-m-d H:i:s'); // تأكد من تنسيق التاريخ بشكل صحيح

            if ($status == 'active') {
                $query->where('end_date', '>=', $now)
                      ->whereRaw('raised_amount < goal_amount');
            } elseif ($status == 'completed') {
                $query->whereRaw('raised_amount >= goal_amount');
            } elseif ($status == 'expired') {
                $query->where('end_date', '<', $now)
                      ->whereRaw('raised_amount < goal_amount');
            }
        }

        // فلتر التاريخ (الجزء المعدل)
        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $causes = $query->paginate(10)->appends($request->query());

        return view('admin.causes.index', compact('causes'));
    }

    /**
     * عرض نموذج إضافة حملة جديدة.
     */
    public function create()
    {
        return view('admin.causes.create');  // عرض صفحة إضافة حملة
    }

    /**
     * عرض نموذج تعديل حملة.
     */
    public function edit($id)
    {
        $cause = Cause::findOrFail($id);
        return view('admin.causes.edit', compact('cause'));
    }

    /**
     * حفظ الحملة الجديدة.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'raised_amount' => 'required|numeric|min:0',
            'goal_amount' => 'required|numeric|min:1',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'responsible_person_name' => 'nullable|string|max:255',
            'responsible_person_email' => 'nullable|email|max:255',
            'additional_details' => 'nullable|string',
            'extra_raised_amount' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // معالجة رفع الصورة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('causes', 'public');
            $data['image'] = $imagePath;
        }

        // إضافة المستخدم الحالي كمسؤول عن الحملة
        $data['user_id'] = Auth::id();

        // إنشاء الحملة مع جميع البيانات
        Cause::create($data);

        return redirect()->route('admin.causes.index')
            ->with('alert', [
                'title' => 'تمت الإضافة!',
                'text' => 'تم إضافة الحملة بنجاح.',
                'icon' => 'success'
            ]);
    }

    /**
     * تحديث الحملة.
     */
    public function update(Request $request, $id)
    {
        $cause = Cause::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'raised_amount' => 'required|numeric',
            'goal_amount' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'responsible_person_name' => 'nullable|string|max:255',
            'responsible_person_email' => 'nullable|email|max:255',
            'additional_details' => 'nullable|string',
            'extra_raised_amount' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($cause->image) {
                Storage::disk('public')->delete($cause->image);
            }
            $data['image'] = $request->file('image')->store('causes', 'public');
        }

        $cause->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الحملة بنجاح!',
                'alert' => [
                    'title' => 'تم التحديث!',
                    'text' => 'تم تحديث الحملة بنجاح.',
                    'icon' => 'success'
                ]
            ]);
        }

        return redirect()->route('admin.causes.index')
            ->with('alert', [
                'title' => 'تم التحديث!',
                'text' => 'تم تحديث الحملة بنجاح.',
                'icon' => 'success'
            ]);
    }

    /**
     * حذف الحملة.
     */
    public function destroy($id)
    {
        $cause = Cause::findOrFail($id);

        // حذف الصورة المرتبطة إذا وجدت
        if ($cause->image) {
            Storage::disk('public')->delete($cause->image);
        }

        $cause->delete();

        if(request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'تم حذف الحملة بنجاح!']);
        }

        return redirect()->route('admin.causes.index')->with('success', 'تم حذف الحملة بنجاح!');
    }

    /**
     * عرض تفاصيل حملة واحدة.
     */
    public function show($id)
    {
        $cause = Cause::findOrFail($id);
        return view('admin.causes.show', compact('cause'));  // عرض تفاصيل الحملة
    }
}
// namespace App\Http\Controllers\Admin;

// use App\Models\Cause;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Auth;

// class AdminCauseController extends Controller
// {
//     /**
//      * عرض جميع الحملات.
//      */
//     public function index(Request $request)
//     {
//         $query = Cause::query();

//         // فلتر البحث العام
//         if ($request->has('search')) {
//             $search = $request->search;
//             $query->where(function($q) use ($search) {
//                 $q->where('title', 'like', "%$search%")
//                   ->orWhere('description', 'like', "%$search%");
//             });
//         }

//         // فلتر نطاق المبلغ
//         if ($request->has('amount_range')) {
//             $range = $request->amount_range;
//             if ($range == '0-1000') {
//                 $query->whereBetween('raised_amount', [0, 1000]);
//             } elseif ($range == '1000-5000') {
//                 $query->whereBetween('raised_amount', [1000, 5000]);
//             } elseif ($range == '5000-10000') {
//                 $query->whereBetween('raised_amount', [5000, 10000]);
//             } elseif ($range == '10000+') {
//                 $query->where('raised_amount', '>', 10000);
//             }
//         }

//         // فلتر حالة الحملة (الجزء المعدل)
//         if ($request->has('status')) {
//             $status = $request->status;
//             $now = now()->format('Y-m-d H:i:s'); // تأكد من تنسيق التاريخ بشكل صحيح

//             if ($status == 'active') {
//                 $query->where('end_date', '>=', $now)
//                       ->whereRaw('raised_amount < goal_amount');
//             } elseif ($status == 'completed') {
//                 $query->whereRaw('raised_amount >= goal_amount');
//             } elseif ($status == 'expired') {
//                 $query->where('end_date', '<', $now)
//                       ->whereRaw('raised_amount < goal_amount');
//             }
//         }

//         // فلتر التاريخ (الجزء المعدل)
//         if ($request->has('start_date') && !empty($request->start_date)) {
//             $query->whereDate('created_at', '>=', $request->start_date);
//         }
//         if ($request->has('end_date') && !empty($request->end_date)) {
//             $query->whereDate('created_at', '<=', $request->end_date);
//         }

//         $causes = $query->paginate(10)->appends($request->query());

//         return view('admin.causes.index', compact('causes'));
//     }

//     /**
//      * عرض نموذج إضافة حملة جديدة.
//      */
//     public function create()
//     {
//         return view('admin.causes.create');  // عرض صفحة إضافة حملة
//     }

//     /**
//      * حفظ الحملة الجديدة.
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'description' => 'required|string',
//             'raised_amount' => 'required|numeric|min:0',
//             'goal_amount' => 'required|numeric|min:1',
//             'category' => 'nullable|string|max:255',
//             'location' => 'nullable|string|max:255',
//             'responsible_person_name' => 'nullable|string|max:255',
//             'responsible_person_email' => 'nullable|email|max:255',
//             'additional_details' => 'nullable|string',
//             'extra_raised_amount' => 'nullable|numeric|min:0',
//             'end_date' => 'nullable|date|after_or_equal:today',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);

//         $data = $request->all();

//         // معالجة رفع الصورة
//         if ($request->hasFile('image')) {
//             $imagePath = $request->file('image')->store('causes', 'public');
//             $data['image'] = $imagePath;
//         }


//         // إضافة المستخدم الحالي كمسؤول عن الحملة
//         $data['user_id'] = Auth::id();

//         // إنشاء الحملة مع جميع البيانات
//         Cause::create($data);

//         return redirect()->route('admin.causes.index')
//             ->with('alert', [
//                 'title' => 'تمت الإضافة!',
//                 'text' => 'تم إضافة الحملة بنجاح.',
//                 'icon' => 'success'
//             ]);
//     }

//     /**
//      * تحديث الحملة.
//      */
//     public function update(Request $request, $id)
//     {
//         $cause = Cause::findOrFail($id);

//         $request->validate([
//             'title' => 'required|string|max:255',
//             'description' => 'required|string',
//             'raised_amount' => 'required|numeric',
//             'goal_amount' => 'required|numeric',
//             'category' => 'nullable|string|max:255',
//             'location' => 'nullable|string|max:255',
//             'responsible_person_name' => 'nullable|string|max:255',
//             'responsible_person_email' => 'nullable|email|max:255',
//             'additional_details' => 'nullable|string',
//             'extra_raised_amount' => 'nullable|numeric',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);

//         $data = $request->all();

//         if ($request->hasFile('image')) {
//             if ($cause->image) {
//                 Storage::disk('public')->delete($cause->image);
//             }
//             $data['image'] = $request->file('image')->store('causes', 'public');
//         }

//         $cause->update($data);

//         if ($request->ajax()) {
//             return response()->json([
//                 'success' => true,
//                 'message' => 'تم تحديث الحملة بنجاح!',
//                 'alert' => [
//                     'title' => 'تم التحديث!',
//                     'text' => 'تم تحديث الحملة بنجاح.',
//                     'icon' => 'success'
//                 ]
//             ]);
//         }

//         return redirect()->route('admin.causes.index')
//             ->with('alert', [
//                 'title' => 'تم التحديث!',
//                 'text' => 'تم تحديث الحملة بنجاح.',
//                 'icon' => 'success'
//             ]);
//     }

//     /**
//      * حذف الحملة.
//      */
//     public function destroy($id)
//     {
//         $cause = Cause::findOrFail($id);

//         // حذف الصورة المرتبطة إذا وجدت
//         if ($cause->image) {
//             Storage::disk('public')->delete($cause->image);
//         }

//         $cause->delete();

//         if(request()->ajax() || request()->wantsJson()) {
//             return response()->json(['success' => true, 'message' => 'تم حذف الحملة بنجاح!']);
//         }

//         return redirect()->route('admin.causes.index')->with('success', 'تم حذف الحملة بنجاح!');
//     }

//     /**
//      * عرض تفاصيل حملة واحدة.
//      */
//     public function show($id)
//     {
//         $cause = Cause::findOrFail($id);
//         return view('admin.causes.show', compact('cause'));  // عرض تفاصيل الحملة
//     }
// }
