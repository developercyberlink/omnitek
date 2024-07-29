@extends('themes.default.common.master')
@section('content')
    <section class="uk-section bg-light">

        <div class="uk-container uk-container-large">
            <div class="uk-flex uk-flex-middle uk-flex-center">
                <div class="uk-width-large@m ">
                    <div class="uk-card uk-card-default uk-padding uk-text-center">
                        <h1 class="uk-h3 uk-text-bold text-primary">LOG IN</h1>
                        <form method="post" action=" {{ route('applicant.login.store') }} ">
                            @csrf
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" type="text" name="email" placeholder="Email"
                                    aria-label="Large">
                            </div>
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" type="password" name="password" placeholder="Password"
                                    aria-label="Large">
                            </div>
                            <div>
                                <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Log In</button>
                            </div>
                            <div>
                                <p class="login-text">OR</p>
                            </div>
                            <p class="text-center">Don't have an account? <a class="text-accent"
                                    href="{{ route('applicant.register') }}">Sign Up</a> </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
