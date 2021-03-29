@extends('layouts.baseAuth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            @include('components.alert')
                            <div class="text-center">
                                <a href="{{ route('landingpage') }}"><img src="{{ asset('assets/img/stmik-logo.png') }}" alt="STMIK Logo" class="text-center img-fluid mb-4" width="200px"></a>
                            </div>
                            <h1>Login</h1>
                            <p class="text-muted">Silakan melakukan login.</p>
                            <form method="POST" action="{{ route('login') }}" novalidate>
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-envelope-closed"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="{{ trans('login.placeholders.email') }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-lock-locked"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="{{ trans('login.placeholders.password') }}" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Ingat Saya
                                                </label>
                                            </div>
                                            <a href="{{ route('register') }}" class="btn btn-link">Belum punya akun?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary float-right">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
