@extends('layouts.app')
@section('content')

            <div class="panel mt30 mb25">
              <!--  -->
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="panel-body bg-light p25 pb15">
                <input type="hidden" id="g_recaptcha_response" name="g_recaptcha_response" />
                  <!-- Social Login Buttons -->
                  <div class="section row">
                  </div>

                  <!-- Divider -->
                  <div class="section-divider1 mv30">
                  </div>

                  <!-- Username Input -->
                  <div class="section {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="username" class="field-label text-muted fs18 mb10">Username</label>
                    <label for="username" class="field prepend-icon">                   
                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required class="gui-input" placeholder="Enter username">
                     <label for="username" class="field-icon">
                      <i class="fa fa-user"></i>
                    </label>
                  </label>

                  @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>

                <!-- Password Input -->
                <div class="section {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                  <label for="password" class="field prepend-icon">
                   <input id="password" type="password" class="form-control" name="password" required  class="gui-input" placeholder="Enter password">
                   <label for="password" class="field-icon">
                    <i class="fa fa-lock"></i>
                  </label>
                </label>
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
               <!-- PIN Input -->
               <div class="section {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="pin" class="field-label text-muted fs18 mb10">PIN</label>
                  <label for="pin" class="field prepend-icon">
                   <input id="pin" type="password" class="form-control" maxlength="6" name="pin" class="gui-input" placeholder="Enter pin" required />
                   <label for="pin" class="field-icon">
                    <i class="fa fa-lock"></i>
                  </label>
                </label>
                @if ($errors->has('pin'))
                <span class="help-block">
                  <strong>{{ $errors->first('pin') }}</strong>
                </span>
                @endif
              </div>

            </div>

            <div class="panel-footer clearfix">
              <button type="submit" class="button btn-primary mr10 pull-right">Login</button>
              <label class="switch ib switch-primary mt10">
             
            </label>
          </div>

        </form>
      </div>

@endsection
