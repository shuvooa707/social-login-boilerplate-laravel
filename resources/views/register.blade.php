@extends('layout.layout')


@section('main-section')
<section class="col-12 d-flex  justify-content-center">
    <div class="card shadow" style="width: min-width:220px; width:25em; max-width:820px">
        <div class="card-header">Registration Form</div>
        <div class="card-body">
            <form class="row d-flex" method="post" action="{{ routec('register.submit') }}">
                <div class="form-group col-lg-6">
                    <label for="firstname">Email</label>
                    <input type="text" class="form-control form-control-sm"  name="firstname" id="firstname" placeholder="First Name">
                </div>
				<div class="form-group col-lg-6">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" placeholder="lastname">
                </div>
				<div class="form-group col-lg-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" id="inputEmail" placeholder="Email">
                </div>
				<div class="form-group col-lg-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="phone">
                </div>
                <div class="form-group col-lg-6">
                    <label for="repassword">Password</label>
                    <input type="password" class="form-control form-control-sm" name="password" id="repassword" placeholder="Password">
                </div>
                <div class="form-group col-lg-6">
                    <label for="repassword">Re-Enter Password</label>
                    <input type="password" class="form-control form-control-sm" name="repassword" id="repassword" placeholder="Re-Enter Password">
                </div>
                <div class="form-group col-lg-3">
					<button type="submit" class="btn btn-primary mt-2 btn-sm">Sign Up</button>
				</div>
            </form>
        </div>
    </div>
</section>
@endsection
