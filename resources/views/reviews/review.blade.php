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

@include('layouts.footer')
</body>

<script>
</script>

</html>
