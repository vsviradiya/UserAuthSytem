{{-- @component('mail::message')
# Introduction

<h1>{{ $details['title'] }}</h1>

<p>{{ $details['body'] }}</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}

<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
   
    <p>Thank you</p>
</body>
</html>