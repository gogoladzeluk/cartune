<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarTune</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/temp_styles.css">
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

<div class="main-box">
    <div class="main-box-container">

        <div class="info">
            <div class="info-container">

                <div class="mechanics">
                    <p id="txt">ხ ე ლ ო ს ა ნ ი</p>
                    <div class="mechanicsHead" style="padding: 20px 50px">

                        <div class="mech_left">
                            <img id="prof_pic" src="{{ asset(sprintf('images/%s', $mechanic->profile_picture)) }}"
                                 alt="prof_pic" style="width: 150px; height: 150px; object-fit: cover;">
                            <img id="service" src="{{ asset(sprintf('images/%s', $mechanic->garage_picture)) }}"
                                 alt="service_pic" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>


                        <div class="mech_right" style="margin-left: 25px;">
                            <div class="mech_right_top" style="margin: auto; display: flex; justify-content: center;">
                                <p style="font-size: 20px;" id="score">{{ number_format($mechanic->reviews_avg_rating ?? 0, 1, '.', '') }} / 5 <i
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
                                <a class="href-button" href="javascript:void(0)">{{ $mechanic->mobile }}</a>
                                <a class="href-button" href="{{ route('mechanics.review', ['id' => $mechanic->id]) }}">შეაფასე</a>
                            </div>
                        </div>
                    </div>

                    @foreach($mechanic->reviews()->latest()->get() as $review)
                        <div class="rates">
                            <img src="{{ asset(sprintf('images/%s', $review->user->profile_picture)) }}" alt="prof_pic"
                                 style=" width: 75px; height: 75px; margin-right: 10px; object-fit: cover;">

                            <div>
                                <p id="score"> {{ $review->rating }} / 5 <i class="fa fa-star-o"></i> {{ $review->user->full_name }}</p>
                                <p>{{ $review->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<div class="footer">
    <div class="footer-container">
        <div class="phone">
        </div>

        <div class="footer-center">
            <i class="fa fa-facebook-square fa-2x"></i>
            <i class="fa fa-linkedin-square fa-2x"></i>
        </div>
    </div>
</div>
</body>

<script>
</script>

</html>
