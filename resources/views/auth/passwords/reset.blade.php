@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        {{ __('Contact Us') }}: 591669651
{{--                        <form method="POST" action="{{ route('reset_password') }}">--}}
{{--                            @csrf--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="mobile"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="mobile" type="text"--}}
{{--                                           class="form-control @error('mobile') is-invalid @enderror" name="mobile"--}}
{{--                                           value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>--}}

{{--                                    @error('mobile')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="code"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="code" type="text"--}}
{{--                                           class="form-control @error('code') is-invalid @enderror" name="code"--}}
{{--                                           value="{{ old('code') }}" required autocomplete="code" autofocus>--}}

{{--                                    @error('code')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <a class="get-code" href="#"--}}
{{--                                   data-url="{{ route('mobile_verification.send_code') }}">{{ __('Get Code') }}</a>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="password"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password"--}}
{{--                                           class="form-control @error('password') is-invalid @enderror" name="password"--}}
{{--                                           required autocomplete="new-password">--}}

{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="password-confirm"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password-confirm" type="password" class="form-control"--}}
{{--                                           name="password_confirmation" required autocomplete="new-password">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-0">--}}
{{--                                <div class="col-md-6 offset-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        {{ __('Reset Password') }}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
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
