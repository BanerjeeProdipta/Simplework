@component('mail::message')
# Simplework

Check out my website.

@component('mail::button', ['url' => '/'])
Articles
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
