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

<div class="main-box">

    <div class="info">

        <div class="mechanics">
            <p id="txt">ხ ე ლ ო ს ა ნ ი</p>
            <div class="mechanicsHead" style="padding: 20px 50px">

                <div class="mech_left">
                    <img id="prof_pic" src="{{ $mechanic->profile_picture_url }}"
                         alt="prof_pic" style="width: 150px; height: 150px; object-fit: cover;">
                    <img id="service" src="{{ $mechanic->garage_picture_url }}"
                         alt="service_pic" style="width: 150px; height: 150px; object-fit: cover;">
                </div>


                <div class="mech_right" style="margin-left: 25px;">
                    <div class="mech_right_top" style="margin: auto; display: flex; justify-content: center;">
                        <p style="font-size: 20px;"
                           id="score">{{ number_format($mechanic->reviews_avg_rating ?? 0, 1, '.', '') }} / 5 <i
                                class="fa fa-star-o"></i>
                        {{ $mechanic->full_name }}
                        <p>
                    </div>

                    <div class="mech_mid" style="display: flex">
                        <div class="mech_right_left">
                            <p class="place">{{ $mechanic->town->title }}</p>
                            <p class="place">{{ $mechanic->district->title }}</p>
                            <p class="place" style="word-wrap: break-word;">{{ $mechanic->address }}</p>
                        </div>

                        <div class="mech_right_right" style="margin-left: 25px;">
                            @foreach($mechanic->services as $service)
                                <p class="specialty">{{ $service->title }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="mech_right_bottom"
                         style="margin: auto; display: flex; justify-content: center;">
                        <a onclick="myFunction()" class="href-button" id="num"
                           href="javascript:void(0)">{{ $mechanic->mobile }}</a>

                        @if(Auth::id() != $mechanic->id)
                            <a class="href-button"
                               href="{{ route('mechanics.review', ['id' => $mechanic->id]) }}">შეაფასე</a>
                        @endif
                    </div>
                </div>
            </div>

            @foreach($mechanic->reviews()->latest()->get() as $review)
                <div class="rates">
                    <img src="{{ $review->user->profile_picture_url }}" alt="prof_pic"
                         style=" width: 75px; height: 75px; margin-right: 10px; object-fit: cover;">

                    <div>
                        <p id="score"> {{ $review->rating }} / 5 <i
                                class="fa fa-star-o"></i> {{ $review->user->full_name }}</p>
                        <p>{{ $review->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('layouts.footer')
</body>

<script>
    function myFunction() {
        navigator.clipboard.writeText({{ $mechanic->mobile }});
    }
</script>

</html>
