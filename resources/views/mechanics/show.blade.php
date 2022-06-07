<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarTune</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/temp_styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ __('Register') }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('register_user') }}">
                                {{ __('As User') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('register_mechanic') }}">
                                {{ __('As Mechanic') }}
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->is_mechanic)
                                <a class="dropdown-item" href="{{ route('mechanics.show', ['id' => Auth::id()]) }}">{{ __('Profile') }}</a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="main-box">

    <div class="info">

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
                        <a class="href-button" href="javascript:void(0)">{{ $mechanic->mobile }}</a>

                        @if(Auth::id() != $mechanic->id)
                        <a class="href-button"
                           href="{{ route('mechanics.review', ['id' => $mechanic->id]) }}">შეაფასე</a>
                        @endif
                    </div>
                </div>
            </div>

            @foreach($mechanic->reviews()->latest()->get() as $review)
                <div class="rates">
                    <img src="{{ asset(sprintf('images/%s', $review->user->profile_picture)) }}" alt="prof_pic"
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

<footer class="d-flex flex-wrap justify-content-start align-items-center mt-auto py-3 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"></svg>
        </a>
        <span class="text-muted">© {{ now()->year }} CarTune, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-center list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="https://www.facebook.com/CarTuuune/" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="https://www.linkedin.com/company/cartune0/" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
    </ul>
</footer>
</body>

<script>
</script>

</html>
