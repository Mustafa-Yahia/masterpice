<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('volunteers')
                     ->orderBy('date', 'asc')
                     ->get();

        return view('events.events', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with(['volunteers' => function($query) {
                        $query->select('users.id', 'name');
                     }])
                     ->findOrFail($id);

        $isRegistered = auth()->check() ? $event->volunteers->contains(auth()->id()) : false;

        return view('events.event-single', compact('event', 'isRegistered'));
    }

    public function subscribe($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = auth()->user();

        if ($event->volunteers()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('warning', 'أنت مسجل بالفعل في هذه الحملة.');
        }

        if ($event->volunteer_count >= $event->volunteers_needed) {
            return redirect()->back()->with('error', 'عذراً، لقد تم استكمال عدد المتطوعين المطلوب.');
        }

        \DB::transaction(function() use ($event, $user) {
            $event->volunteers()->attach($user->id);
            $event->increment('volunteer_count');
        });

        return redirect()->back()->with('success', 'تم تسجيلك في الحملة التطوعية بنجاح!');
    }

    public function unsubscribe($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = auth()->user();

        if (!$event->volunteers()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'أنت غير مسجل في هذه الحملة.');
        }

        \DB::transaction(function() use ($event, $user) {
            $event->volunteers()->detach($user->id);
            $event->decrement('volunteer_count');
        });

        return redirect()->back()->with('success', 'تم إلغاء تسجيلك من الحملة التطوعية.');
    }
}
