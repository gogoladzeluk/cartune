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
                            <img class="img-responsive rounded" src="{{ Auth::user()->profile_picture_url }}" style="width: 25px; height: 25px; object-fit: cover; margin-right: 5px;">
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

    <div class="col-md-4 d-flex justify-content-center">
        <span class="text-muted">{{ __('Contact') }}: +995 555 29 02 70</span>
    </div>
</footer>

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
