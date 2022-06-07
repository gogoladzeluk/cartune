<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarTune</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/temp_styles.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Bootstrap Multiselect CSS -->
    <link rel="stylesheet" href="css/bootstrap-multiselect.css">

</head>

<body>
<div class="header">
    <div class="header-container">
        <div class="logo">
            <a href="{{ route('home') }}" class="logo">CarTune</a>
        </div>
        <div class="header-right">
            <a href="{{ route('register_choose') }}">{{ __('Register') }}</a>
        </div>
        <div class="header-right">
            <a href="{{ route('login') }}">{{ __('Login') }}</a>
        </div>
    </div>
</div>


<p style="margin-top: 2%" id="txt">მოძებე შენთვის სასურველი სპეციალისტი</p>

@foreach($mechanics as $mechanic)
    <a href="{{ route('mechanics.show', ['id' => $mechanic->id]) }}">
        <div style="width: 40%; margin-left:30%; " class="rates">
            <img src="{{ asset(sprintf('images/%s', $mechanic->profile_picture)) }}" alt="prof_pic" style=" width: 75px;
            height: 75px; margin-right: 10px; object-fit: cover;">

            <div>
                <p id="score"> {{ number_format($mechanic->reviews_avg_rating ?? 0, 1, '.', '') }} / 5 <i
                        class="fa fa-star-o"></i> {{ $mechanic->full_name }}</p>
                <div style="display: flex;">
                    @foreach($mechanic->services->filter(fn($value, $key) => in_array($value->id, request()->get('services') ?? $services->pluck('id')->toArray()))->take(3) as $service)
                        <p style="display:flex; margin-left: 2%;" class="specialty">{{ $service->title }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </a>
@endforeach

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<div class="footer">
    <div class="footer-container">
        <div class="footer-center">
            <a href="https://www.facebook.com/CarTuuune/" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
            <a href="https://www.linkedin.com/company/cartune0/" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<!-- Bootstrap Multiselect JS -->
<script data-main="dist/js/" src="js/require.min.js"></script>
<script>
    require(['bootstrap-multiselect'], function (purchase) {
        $('#mySelect').multiselect();
    });
</script>

</body>

</html>
