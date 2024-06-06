<?php

namespace App\View\Components;

use App\Models\BOForm;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSidebar extends Component
{
    public $totalForms;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->totalForms = BOForm::count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-sidebar');
    }
}
