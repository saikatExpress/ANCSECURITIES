<?php

namespace App\View\Components;

use Closure;
use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TopBar extends Component
{
    public $setting;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->setting = Setting::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top-bar');
    }
}
