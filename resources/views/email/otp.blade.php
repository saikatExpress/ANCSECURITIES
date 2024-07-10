@component('mail::message')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

# Your OTP for Registration

Hello,

Your OTP for registration is: **{{ $otp }}**

Thank you for registering.

{{-- Subcopy --}}
@slot('subcopy')
    @component('mail::subcopy')
        If you have any trouble receiving your OTP, please contact us at <a href="tel:0171352712">0171352712</a>.
    @endcomponent
@endslot

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    @endcomponent
@endslot
@endcomponent
