 <?php

namespace App\Http\Controllers\Admin;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDonationController extends Controller
{
    /**
     * عرض جميع التبرعات.
     */
    public function index()
    {
        $donations = Donation::all();
        return view('admin.donations.index', compact('donations'));
    }

    /**
     * عرض نموذج إضافة تبرع جديد.
     */
    public function create()
    {
        return view('admin.donations.create');
    }

    /**
     * حفظ التبرع الجديد.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'raised_amount' => 'required|numeric',
            'goal_amount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'end_time' => 'nullable|date',
            'category' => 'nullable|string',
            'location' => 'nullable|string',
            'responsible_person_name' => 'nullable|string',
            'responsible_person_email' => 'nullable|email',
        ]);

        Donation::create($request->all());

        return redirect()->route('admin.donations.index')->with('success', 'تم إضافة التبرع بنجاح!');
    }

    /**
     * عرض التبرع للتعديل.
     */
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.edit', compact('donation'));
    }

    /**
     * تحديث التبرع.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'raised_amount' => 'required|numeric',
            'goal_amount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'end_time' => 'nullable|date',
            'category' => 'nullable|string',
            'location' => 'nullable|string',
            'responsible_person_name' => 'nullable|string',
            'responsible_person_email' => 'nullable|email',
        ]);

        $donation = Donation::findOrFail($id);
        $donation->update($request->all());

        return redirect()->route('admin.donations.index')->with('success', 'تم تحديث التبرع بنجاح!');
    }

    /**
     * حذف التبرع.
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'تم حذف التبرع بنجاح!');
    }
}
