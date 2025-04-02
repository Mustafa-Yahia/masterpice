<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function showForm()
    {
        $volunteerPrograms = \App\Models\VolunteerProgram::all();

        return view('volunteer', compact('volunteerPrograms'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'birth_date' => 'required|date|before:' . \Carbon\Carbon::now()->subYears(18)->toDateString(),
                'phone' => ['required', 'regex:/^\+?[0-9]{8,15}$/'],
                'nationality' => 'required|string|max:100',
                'gender' => 'required|string|max:10',
                'country' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'occupation' => 'nullable|string|max:100',
                'email' => 'required|email|max:255|unique:volunteers,email',
                'volunteer_programs' => 'required|array|min:1',
                'previous_volunteer' => 'required|boolean',
                'how_heard' => 'nullable|string|max:100',
                'volunteer_experience' => 'nullable|string',
                'national_id' => [
                    'nullable',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->nationality === 'الأردنية') {
                            if (!$value) {
                                $fail('الرقم الوطني مطلوب للمواطنين الأردنيين.');
                            } elseif (!preg_match('/^2\d{9}$/', $value)) {
                                $fail('يجب أن يتكون الرقم الوطني من 10 أرقام ويبدأ بالرقم 2.');
                            }
                        }
                    },
                    'unique:volunteers,national_id',
                ],
            ], [
                'volunteer_programs.required' => 'يجب اختيار برنامج تطوعي واحد على الأقل.',
                'volunteer_programs.min' => 'يجب اختيار برنامج تطوعي واحد على الأقل.',
            ]);

            $volunteer = Volunteer::create([
                'full_name' => $validatedData['full_name'],
                'birth_date' => $validatedData['birth_date'],
                'phone' => $validatedData['phone'],
                'nationality' => $validatedData['nationality'],
                'gender' => $validatedData['gender'],
                'country' => $validatedData['country'],
                'city' => $validatedData['city'],
                'occupation' => $validatedData['occupation'] ?? null,
                'email' => $validatedData['email'],
                'previous_volunteer' => $validatedData['previous_volunteer'],
                'how_heard' => $validatedData['how_heard'] ?? null,
                'volunteer_experience' => $validatedData['volunteer_experience'] ?? null,
                'national_id' => $validatedData['national_id'] ?? null,
            ]);

            $volunteer->programs()->attach($validatedData['volunteer_programs']);

            return redirect()->back()->with('success', 'تم إرسال البيانات بنجاح!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء معالجة الطلب، يرجى المحاولة مرة أخرى.');
        }
    }
}
