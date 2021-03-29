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
                            <h1>Registrasi</h1>
                            <p class="text-muted">Silakan melakukan registrasi.</p>
                            <form method="POST" action="{{ route('register') }}" novalidate>
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-user"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('nama') is-invalid @enderror" type="text" placeholder="{{ trans('login.placeholders.nama') }}" name="nama" value="{{ old('nama') }}" required autofocus>
                                        @error('nama')
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
                                                <i class="cil-envelope-closed"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="{{ trans('login.placeholders.email') }}" name="email" value="{{ old('email') }}" required>
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
                                                <i class="cil-institution"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('nim') is-invalid @enderror" type="text" placeholder="{{ trans('login.placeholders.nim') }}" name="nim" value="{{ old('nim') }}" required>
                                        @error('nim')
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
                                                <i class="cil-people"></i>
                                            </span>
                                        </div>
                                        <select class="form-control @error('jen_kel') is-invalid @enderror" name="jen_kel" required>
                                            <option>{{ trans('login.placeholders.jen_kel') }}</option>
                                            @foreach (config('constant.jen_kel') as $item)
                                            <option value="{{ $item }}" {{ $item == old('jen_kel') ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('jen_kel')
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
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="cil-lock-locked"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="{{ trans('login.placeholders.password_confirmation') }}" name="password_confirmation" required>
                                        @error('password_confirmation')
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
                                                <i class="cil-phone"></i>
                                            </span>
                                        </div>
                                        <input class="form-control @error('no_hp') is-invalid @enderror" type="tel" placeholder="{{ trans('login.placeholders.no_hp') }}" name="no_hp" value="{{ old('no_hp') }}" required>
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary float-right">Registrasi</button>
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
