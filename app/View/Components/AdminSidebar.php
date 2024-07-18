<?php

namespace App\View\Components;

use Closure;
use Carbon\Carbon;
use App\Models\BOForm;
use App\Models\LimitRequest;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

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
