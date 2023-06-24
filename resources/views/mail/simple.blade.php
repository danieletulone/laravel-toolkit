@component('mail::message')
<p style="text-align: center">
    {!! $body !!}
</p>

@component('mail.components.sign', ['locale' => $locale]) @endcomponent
@endcomponent