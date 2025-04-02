<?php

namespace App\Http\Controllers;
use App\Models\Cause;
use App\Models\DonationCategory;
use Illuminate\Http\Request;

class DonationCategoryController extends Controller
{
    // استرجاع التبرعات والفئات والأسباب في نفس الصفحة
    public function indexWithCauses()
    {
        // استرجاع الفئات من قاعدة البيانات
        $categories = DonationCategory::paginate(6);

        // استرجاع الأسباب من قاعدة البيانات
        $causes = Cause::all();

        // تمرير البيانات إلى الـ View
        return view('index', compact('categories', 'causes'));
    }

    // عرض تفاصيل التبرع
    public function show($id)
    {
        $category = DonationCategory::findOrFail($id);
        return view('donations.show', compact('category'));
    }

    // معالجة التبرع
    public function processDonation(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // العثور على فئة التبرع المطلوبة
        $category = DonationCategory::findOrFail($id);

        return redirect()->route('donation.show', $id)->with('success', 'تمت عملية التبرع بنجاح!');
    }

    // عرض التبرعات المنفصلة
    public function separateDonations()
    {
        $separateDonations = SeparateDonation::all();
        return view('donations.separate', compact('separateDonations'));
    }
}
