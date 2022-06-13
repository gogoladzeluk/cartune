<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/temp_styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
@include('layouts.header')

<p style="margin-top: 2%" id="txt">მოძებე შენთვის სასურველი სპეციალისტი</p>

@foreach($mechanics as $mechanic)
    <a href="{{ route('mechanics.show', ['id' => $mechanic->id]) }}">
        <div class="rates">
            <img src="{{ $mechanic->profile_picture_url }}" alt="prof_pic" style=" width: 75px;
            height: 75px; margin-right: 10px; object-fit: cover;">

            <div style="width: auto; overflow: auto;">
                <p id="score"> {{ number_format($mechanic->reviews_avg_rating ?? 0, 1, '.', '') }} / 5 <i
                        class="fa fa-star-o"></i> {{ $mechanic->full_name }}</p>
                <div class="specialties" style="display: flex; overflow-x: auto;">
                    @foreach($mechanic->services as $service)
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

@include('layouts.footer')

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
