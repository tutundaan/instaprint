@extends('layouts.main-navbarless')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-body login-card-body text-center">
                    <img src="{{ asset('image/logo.png') }}" alt="Instaprint Logo" class="pb-4">
                    <form action="{{ route('login') }}" method="post" data-parsley-validate>
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ old('phone') }}" required data-parsley-type="number">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
