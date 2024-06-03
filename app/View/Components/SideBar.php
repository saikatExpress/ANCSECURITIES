<?php

namespace App\View\Components;

use App\Models\FormUpload;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    public $forms;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->forms = FormUpload::where('status', '1')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar');
    }
}
