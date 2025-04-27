<?php
namespace App\View\Components;

use Illuminate\View\Component;

class UserSidebar extends Component
{
    public $subscriptions;

    // يمكن إضافة بيانات أخرى تحتاجها في الـ Sidebar
    public function __construct($subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function render()
    {
        return view('components.user-sidebar'); // تحديد الـ view الذي سيعرض الـ Sidebar
    }
}
