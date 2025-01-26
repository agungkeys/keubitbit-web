<!DOCTYPE html>
@php
  $dateVariable = now();
  $formattedDate = \Carbon\Carbon::parse($dateVariable)->format('d-m-Y');
@endphp
<html>
<head>
    <title>Contact Form Submission {{$formattedDate}}</title>
</head>
<body>
    <h2>New Contact Form Submission {{$formattedDate}}</h2>
    <p><strong>Name:</strong> {{ $details['name'] }}</p>
    <p><strong>Email:</strong> {{ $details['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $details['message'] }}</p>
</body>
</html>
