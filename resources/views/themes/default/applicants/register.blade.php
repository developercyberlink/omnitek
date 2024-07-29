@extends('themes.default.common.master')
@section('content')
    <section class="uk-section bg-light">
        <div class="uk-container uk-container-large">
            <div class="uk-flex uk-flex-middle uk-flex-center">
                <div class="uk-width-large@m ">
                    <div class="uk-card uk-card-default uk-padding uk-text-center">
                        <h1 class="uk-h3 uk-text-bold text-primary">REGISTER HERE</h1>
                        <form method="post" action="{{ route('applicant.register.store') }}">
                            @csrf
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" name="first_name" type="text" placeholder="Full Name"
                                    aria-label="Large">
                            </div>
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" name="last_name" type="text" placeholder="Full Name"
                                    aria-label="Large">
                            </div>
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" name="email" type="text" placeholder="Email"
                                    aria-label="Large">
                            </div>
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" name="password" type="password" placeholder="Password"
                                    aria-label="Large">
                            </div>
                            <div class="uk-margin">
                                <input class="uk-input uk-width-1-1" name="password_confirmation" type="password"
                                    placeholder="Confirm Password" aria-label="Large">
                            </div>
                            <div>
                                <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Register
                                    Now</button>
                            </div>

                            <p class="text-center">Already have an account. <a class="text-accent"
                                    href="{{ route('applicant.login') }}">Log
                                    In</a> </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
