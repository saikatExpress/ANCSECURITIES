<?php

namespace App\View\Components;

use Closure;
use App\Models\Fund;
use App\Models\Contact;
use App\Models\LimitRequest;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Message extends Component
{
    public $messages, $limits, $withdraw, $deposite;
    public $notifications = [];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->messages = Contact::where('is_rcv', 0)->get();

        $this->limits   = LimitRequest::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('status', 'pending')->get();
        $this->withdraw = Fund::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('category', 'withdraw')->where('status', 'pending')->get();
        $this->deposite = Fund::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('category', 'deposit')->where('status', 'pending')->get();

        foreach ($this->limits as $limit) {
            $this->notifications[] = [
                'type' => 'limit',
                'data' => $limit,
                'created_at' => $limit->created_at
            ];
        }

        foreach ($this->withdraw as $withdraw) {
            $this->notifications[] = [
                'type' => 'withdraw',
                'data' => $withdraw,
                'created_at' => $withdraw->created_at
            ];
        }

        foreach ($this->deposite as $deposit) {
            $this->notifications[] = [
                'type' => 'deposit',
                'data' => $deposit,
                'created_at' => $deposit->created_at
            ];
        }

        usort($this->notifications, function($a, $b) {
            return $b['created_at']->timestamp - $a['created_at']->timestamp;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message');
    }
}
