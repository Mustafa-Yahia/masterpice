<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // عرض جميع الأحداث
    public function index()
    {
        // جلب جميع الأحداث من قاعدة البيانات
        $events = Event::all();

        // عرض الأحداث في صفحة events
        return view('events.events', compact('events'));
    }

    // عرض تفاصيل الحدث
    public function show($id)
    {
        // جلب الحدث بناءً على الـ id
        $event = Event::findOrFail($id);

        // عرض تفاصيل الحدث في صفحة event-single
        return view('events.event-single', compact('event'));
    }


    public function subscribe($eventId)
    {
        $event = Event::find($eventId); // جلب الحدث حسب الـ ID
        $user = auth()->user(); // الحصول على المستخدم المسجل دخوله

        if ($event && $event->volunteers_needed > $event->volunteer_count) {
            // زيادة عدد المتطوعين
            $event->volunteer_count += 1;
            $event->save();

            // إضافة المتطوع إلى جدول متطوعين (إذا كان لديك جدول لتخزين المتطوعين)
            $event->volunteers()->attach($user->id);

            // إرسال رسالة نجاح
            return redirect()->back()->with('message', 'تم الاشتراك في الحدث بنجاح!');
        }

        // إذا تم استكمال عدد المتطوعين
        return redirect()->back()->with('message', 'لقد تم استكمال عدد المتطوعين.');
    }



    // // اشتراك المستخدم في الحدث
    // public function subscribe($id)
    // {
    //     // تحقق مما إذا كان المستخدم مسجلاً في الجلسة
    //     if (!Auth::check()) {
    //         return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول للاشتراك في الحدث');
    //     }

    //     // جلب الحدث بناءً على الـ id
    //     $event = Event::findOrFail($id);

    //     // التحقق مما إذا كان المستخدم قد اشترك مسبقًا في الحدث
    //     $user = Auth::user();
    //     if ($user->events->contains($event)) {
    //         // إذا كان المستخدم قد اشترك مسبقًا
    //         return redirect()->route('event.show', $id)->with('info', 'لقد قمت بالاشتراك في هذا الحدث مسبقًا.');
    //     }

    //     // إضافة المستخدم إلى الحدث مع حالة "قيد الانتظار"
    //     $user->events()->attach($event, ['status' => 'pending']); // الاشتراك يكون في حالة "قيد الانتظار"

    //     // إعادة توجيه المستخدم إلى تفاصيل الحدث مع رسالة نجاح
    //     return redirect()->route('event.show', $id)->with('success', 'تم الاشتراك في الحدث بنجاح! طلبك قيد الانتظار.');
    // }

    // // تحديث حالة الاشتراك (موافقة / رفض)
    // public function updateSubscriptionStatus($eventId, $userId, $status)
    // {
    //     // التحقق من أن الحالة صحيحة
    //     if (!in_array($status, ['pending', 'approved', 'rejected'])) {
    //         return redirect()->route('event.show', $eventId)->with('error', 'الحالة غير صالحة');
    //     }

    //     // العثور على الحدث والمستخدم
    //     $event = Event::findOrFail($eventId);
    //     $user = User::findOrFail($userId);

    //     // تحديث حالة الاشتراك
    //     $event->users()->updateExistingPivot($user->id, ['status' => $status]);

    //     // إعادة توجيه مع رسالة
    //     return redirect()->route('event.show', $eventId)->with('success', 'تم تحديث حالة الاشتراك.');
    // }

}
