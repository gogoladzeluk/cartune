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
                <center>
                    <p id="txt">ხ ე ლ ო ს ა ნ ი</p>
                    <form method="POST" action="{{ route('mechanics.review', ['id' => $mechanic->id]) }}"
                          autocomplete="off">
                        @csrf
                        <div class="revs">
                            <img src="{{ asset(sprintf('images/%s', $mechanic->profile_picture)) }}" alt="prof_pic"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <p id="score">{{ $mechanic->full_name }}</p>

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

                        </div>

                        <div class="btn">
                            <button type="submit">შეფასება</button>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </div>
</div>


<div class="footer">
    <div class="footer-container">
        <div class="footer-center">
            <a href="https://www.facebook.com/CarTuuune/" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
            <a href="https://www.linkedin.com/company/cartune0/" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a>
        </div>
    </div>
</div>
</body>

<script>
</script>

</html>
