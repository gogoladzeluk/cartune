@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register as Mechanic') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register_mechanic') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="first_name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ old('first_name') }}" required
                                           autocomplete="first_name" autofocus>

                                    @error('first_name')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required
                                           autocomplete="last_name" autofocus>

                                    @error('last_name')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="mobile"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
                                           class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                           value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                    @error('mobile')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="row mb-3">--}}
{{--                                <label for="code"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>--}}

{{--                                <div class="col-md-4">--}}
{{--                                    <input id="code" type="text"--}}
{{--                                           class="form-control @error('code') is-invalid @enderror" name="code"--}}
{{--                                           value="{{ old('code') }}" required autocomplete="code" autofocus>--}}

{{--                                    @error('code')--}}
{{--                                    <span class="text-danger" role="alert">--}}
{{--                                                                    <small><strong>{{ $message }}</strong></small>--}}
{{--                                                                </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2">--}}
{{--                                    <a class="get-code" href="#"--}}
{{--                                       data-url="{{ route('mobile_verification.send_code') }}">{{ __('Get Code') }}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="row mb-3">
                                <label for="town_id"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Garage Town') }}</label>

                                <div class="col-md-6">
                                    <select name="town_id" class="form-select">
                                        <option selected value="{{ $towns[0]->id }}">{{ $towns[0]->title }}</option>
                                    </select>

                                    @error('town_id')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="district_id"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Garage District') }}</label>

                                <div class="col-md-6">
                                    <select name="district_id" class="form-select">
                                        <option selected disabled>{{ __('Choose') }}</option>
                                        @foreach($districts as $district)
                                            <option
                                                {{ old('district_id') == $district->id ? "selected" : "" }} value="{{ $district->id }}">{{ $district->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('district_id')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Garage Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                           class="form-control @error('address') is-invalid @enderror" name="address"
                                           value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="service_ids[]"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Services') }}</label>

                                <div class="col-md-6">

                                    <select name="service_ids[]" multiple class="form-select">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('service_ids[]')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile_picture"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture') }}</label>

                                <div class="col-md-6">
                                    <input id="profile_picture" type="file"
                                           class="form-control @error('profile_picture') is-invalid @enderror"
                                           name="profile_picture" value="{{ old('profile_picture') }}" required
                                           autocomplete="profile_picture" autofocus accept="image/*">

                                    @error('profile_picture')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="garage_picture"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Garage Picture') }}</label>

                                <div class="col-md-6">
                                    <input id="garage_picture" type="file"
                                           class="form-control @error('garage_picture') is-invalid @enderror"
                                           name="garage_picture" value="{{ old('garage_picture') }}" required
                                           autocomplete="garage_picture" autofocus accept="image/*">

                                    @error('garage_picture')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <small><strong>{{ $message }}</strong></small>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.get-code').on('click', function (e) {
                e.preventDefault();

                var ajax_url = $(this).data("url");
                var mobile = $("input[name='mobile']").val();

                $.ajax({
                    type: "POST",
                    url: ajax_url,
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        mobile: mobile,
                    },
                    success: function (result) {
                        console.log("code was sent:", result.status);
                    },
                    error: function (result) {
                        console.log("code was not sent");
                    },
                });
            });
        });
    </script>
@endsection
