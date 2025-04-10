<?php

namespace App\Http\Controllers;
use App\Models\Cause;
use App\Models\DonationCategory;
use Illuminate\Http\Request;

class DonationCategoryController extends Controller
{
    public function indexWithCauses()
    {
        $categories = DonationCategory::paginate(6);

        $causes = Cause::all();

        return view('index', compact('categories', 'causes'));
    }

    public function show($id)
    {
        $category = DonationCategory::findOrFail($id);
        return view('donations.show', compact('category'));
    }

    public function processDonation(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $category = DonationCategory::findOrFail($id);

        return redirect()->route('donation.show', $id)->with('success', 'تمت عملية التبرع بنجاح!');
    }

    public function separateDonations()
    {
        $separateDonations = SeparateDonation::all();
        return view('donations.separate', compact('separateDonations'));
    }

    protected $table = 'donation_categories';

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
