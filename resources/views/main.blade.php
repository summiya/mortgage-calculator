<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mortgage Calculator</title>
    @include('partials.header')
</head>
<body>
<div class="container mt-4">

    @if (isset($data))
        @if(isset($data['initial_amortization_schedule']))
            @include('mortgage-calculator.loan-amortization-schedule')
        @else
            @include('mortgage-calculator.extra-repayment-schedule')
        @endif
    @else
        @include('mortgage-calculator.form')
    @endif
</div>
<footer>
    @include('partials.footer')
</footer>
</body>
</html>
