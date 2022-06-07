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
    <div style="margin-top: 300px;" class="main-box-container">

        <div class="info">
            <div class="info-container">
                <center>
                    <div class="revs">
                        <p id="txt">ხ ე ლ ო ს ა ნ ი</p>
                        <img src="{{ $mechanic->profile_picture_url }}" alt="prof_pic"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <p id="score">{{ $mechanic->full_name }}</p>

                        <form method="POST" action="{{ route('mechanics.review', ['id' => $mechanic->id]) }}"
                              autocomplete="off">
                            @csrf
                            <div class="rate">
                                <input type="radio" id="star5" name="rating" value="5"/>
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4"/>
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3"/>
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2"/>
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1"/>
                                <label for="star1" title="text">1 star</label>
                            </div>
                            @error('rating')
                            <span class="text-danger" role="alert">
                                <small><strong>{{ $message }}</strong></small>
                            </span>
                            @enderror

                            <input id="desc" name="content" type="textarea">
                            @error('content')
                            <span class="text-danger" role="alert">
                                <small><strong>{{ $message }}</strong></small>
                            </span>
                            @enderror

                            <br>
                            <br>
                            <br>

                            <div class="btn">
                                <button type="submit">შეფასება</button>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
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
