@extends('layout.master')
@section('title', 'Admin Login')
@section('content')
    <div class="login-section d-flex align-items-center justify-content-center px-3 px-md-0">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('video/bg-new.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung video tag HTML5.
        </video>
        <div class="card rounded-5 border-0 shadow-lg bg-transparent">
            <div class="row">
                <div class="col-lg-6 col-12 d-none d-lg-block py-4 px-5 d-flex justify-content-center align-items-center rounded-start-5"
                    style="background-color: white;">
                    <div class="d-flex flex-column justify-content-center h-100">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/logo-colored.png') }}" alt="" width="280">
                        </div>
                        <div>
                            <h2 class="fw-bold mt-4 text-center">Ganti Password</h2>
                            <p class=" text-center">Silakan ganti password Anda untuk keamanan akun.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 p-5">
                    <div class="text-center">
                        <h3 class="fw-bold text-white">MOLECULE</h3>
                        <h6 class="fw-bold text-white">Ganti Password</h6>
                    </div>
                    <form action="{{ route('changePassword') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-2">
                            <input type="password" class="form-control border-0" required placeholder="Password Lama"
                                name="old_password">
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control border-0" required placeholder="Password Baru"
                                name="new_password">
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control border-0" required
                                placeholder="Konfirmasi Password Baru" name="new_password_confirmation">
                        </div>

                        @if (session('notif'))
                            <div class="alert alert-success mt-2">
                                {{ session('notif') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-light fw-semibold px-5">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        .login-section {
            position: relative;
            overflow: hidden;
            height: 100vh;
        }

        .login-section video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: fill;
            z-index: -1;
        }

        .card {
            backdrop-filter: blur(12px);
        }

        .rounded-start-5 {
            border-top-left-radius: 32px;
            border-bottom-left-radius: 32px;
        }

        @media (min-width: 768px) {
            .card {
                width: 65% !important;
            }
        }

        @media (min-width: 992px) {
            .card {
                width: 80% !important;
            }
        }

        @media (min-width: 1200px) {
            .card {
                width: 50% !important;
            }
        }
    </style>
@endsection
