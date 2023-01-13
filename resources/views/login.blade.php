@extends('layout.layout')


@section('main-section')
    <section class="row justify-content-center">
        <div class="col-lg-5 col-md-5">
            <div class="card">
                <div class="card-header">Login Form</div>
                <div class="card-body">
                    <form method="post" action="{{ routec('login.submit') }}">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input name="email" type="email" class="form-control form-control-sm" id="inputEmail"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input name="password" type="password" class="form-control form-control-sm" id="inputPassword"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label">
                                <input type="checkbox"> Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Sign in</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2" style="">
            <div class="card border-0" style="height:100%; background: transparent;">
                <div class="card-body border-0 justify-content-center" style="display: flex;align-items: center;">
                    <span id="or">
                        or
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-5">
            <div class="card">
                <div class="card-header">Login With Social Media</div>
                <div class="card-body text-center">
                    <div class="col p-0 text-center">
                        <a href="{{ routec('facebook.redirect') }}" class="fb btn">
                            <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                        </a>
                        <a href="{{ routec('microsoft.redirect') }}" class="microsoft btn">
                            <i class="fa fa-windows" aria-hidden="true"></i> Login with Microsoft
                        </a>
                        <a href="{{ routec('google.redirect') }}" class="google btn">
                            <i class="fa fa-google fa-fw"></i> Login with Google+
                        </a>
                        <a href="{{ routec('github.redirect') }}" class="github btn">
                            <i class="fa fa-github" aria-hidden="true"></i> Login with Github
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
