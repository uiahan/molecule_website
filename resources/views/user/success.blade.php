@extends('layout.master')
@section('title', 'Thank You')
@section('content')
    <div class="login-section d-flex align-items-center justify-content-center px-3 px-md-0">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('video/bg-new.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung video tag HTML5.
        </video>
        <div class="card rounded-4 p-5 border-0 shadow-lg bg-transparent">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/logo.webp') }}" width="350" alt="">
            </div>
            <div class="mt-4">
                <div style="height: 2px; background-color: white;"></div>
            </div>
            <div class="mt-3">
                <h4 class=" text-white text-center">Pendaftaran berhasil dilakukan! <br> terimakasih telah mendaftar ke event kami</h4>
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
