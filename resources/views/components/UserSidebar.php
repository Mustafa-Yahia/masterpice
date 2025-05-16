<?php
namespace App\View\Components;

use Illuminate\View\Component;

class UserSidebar extends Component
{
    public $subscriptions;

    public function __construct($subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function render()
    {
        return view('components.user-sidebar'); 
    }
}
