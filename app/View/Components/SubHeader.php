<?php

namespace App\View\Components;

use Closure;
use Carbon\Carbon;
use App\Models\Fund;
use App\Models\LimitRequest;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SubHeader extends Component
{
    public $totalWithdraw,$totalLimit,$totalDeposit;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->totalWithdraw = Fund::where('category', 'withdraw')->where('status', 'pending')->count();
        $this->totalDeposit = Fund::where('category', 'deposit')->where('status', 'pending')->count();
        $this->totalLimit = LimitRequest::whereDate('created_at', Carbon::today())->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sub-header');
    }
}
