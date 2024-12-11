@extends('layout.master')
@section('title', 'Invitation')
@section('content')

    <div class="form-register-section d-flex align-items-center">
        <video id="introVideo" autoplay playsinline muted
            style="width: 100%; height: 100%; object-fit: initial; position: absolute; z-index: 1; cursor: pointer;">
            <source src="{{ asset('video/video-full.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div id="registrationForm" style="display: none; position: relative; z-index: 2;">
            <video autoplay loop muted playsinline>
                <source src="{{ asset('video/bg-new.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung video tag HTML5.
            </video>
            <div class="container px-5 px-lg-0">
                <div class="row d-flex justify-content-center">
                    <div class="card p-4 border-0 shadow bg-transparent"
                        style="color: white; max-height: 600px; overflow-y: auto;">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/logo.webp') }}" width="160" alt="">
                        </div>
                        @if (session('notif'))
                            <div class=" alert mt-4 alert-success">
                                {{ session('notif') }}
                            </div>
                        @endif
                        <form action="{{ route('postAddInvitation') }}" method="POST">
                            @csrf
                            <div class="mt-4">
                                <label for="nama_perusahaan" class="form-label">Nama perusahaan :</label>
                                <input type="text" name="nama" id="nama_perusahaan"
                                    placeholder="Nama perusahaan" class="form-control border-0"
                                    style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label for="domisili_perusahaan" class="form-label">Domisili perusahaan :</label>
                                <input type="text" name="domisili_perusahaan" id="domisili_perusahaan"
                                    placeholder="Domisili perusahaan" class="form-control border-0"
                                    style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label for="peserta" class="form-label">Nama peserta yang akan hadir :</label>
                                <input type="text" name="peserta" id="peserta" placeholder="Nama peserta"
                                    class="form-control border-0" style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label for="jabatan" class="form-label">Jabatan peserta :</label>
                                <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan peserta"
                                    class="form-control border-0" style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label for="jurusan" class="form-label">jurusan peserta :</label>
                                <input type="text" name="jurusan" id="jurusan" placeholder="jurusan peserta"
                                    class="form-control border-0" style="background-color: #ededed" required>
                            </div>
                            <div class="mt-3">
                                <label for="umur" class="form-label">umur peserta :</label>
                                <input type="text" name="umur" id="umur" placeholder="umur peserta"
                                    class="form-control border-0" style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" name="email" id="email" placeholder="Email peserta"
                                    class="form-control border-0" style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label for="no_hp" class="form-label">No Handphone Peserta (pastikan nomor anda terdaftar
                                    di My Pertamina) :</label>
                                <input type="tel" name="no_hp" id="no_hp" placeholder="Nomor HP peserta"
                                    class="form-control border-0" style="background-color: #ededed" required>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Apakah Anda akan menghadiri acara?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="akan_hadir" id="yes"
                                        value="Iya" required>
                                    <label class="form-check-label" for="yes">Iya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="akan_hadir" id="no"
                                        value="Tidak" required>
                                    <label class="form-check-label" for="no">Tidak</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary w-100"
                                    style="background-color: #3599db;">Kirim</button>
                            </div>

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-4 col-md-2 d-flex align-items-center">
                                        <a href="https://play.google.com/store/apps/details?id=com.dafturn.mypertamina&hl=en-US&pli=1">
                                            <img src="{{ asset('img/qr.jpeg') }}" width="80" alt="QR Code">
                                        </a>
                                    </div>
                                    <div class="col-8 col-md-10 p-1 d-flex align-items-center">
                                        <small style="line-height: 1; margin: 0; padding: 0; display: block;">
                                            Download My Pertamina sekarang, dapatkan hadiah Voucher My Pertamina bagi 100
                                            orang yang beruntung di Customer Business Forum 2024
                                        </small>
                                    </div>
                                </div>
                                <div class="row gx-2">
                                    <div class="col-6 mt-3 d-flex justify-content-end">
                                        <a href="https://play.google.com/store/apps/details?id=com.dafturn.mypertamina&hl=en-US&pli=1">
                                            <img src="{{ asset('img/get-on-playstore_compressed.jpg') }}" width="100"
                                                height="35" alt="Play Store">
                                        </a>
                                    </div>
                                    <div class="col-6 mt-3 d-flex justify-content-start">
                                        <a href="https://apps.apple.com/id/app/mypertamina/id1295039064">
                                            <img src="{{ asset('img/get-on-appstore_compressed.jpg') }}" width="100"
                                                alt="App Store">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-register-section {
            position: relative;
            overflow: hidden;
            height: 100vh;
        }

        #registrationForm {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow-y: auto;
        }

        .form-register-section video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: initial;
        }

        .card {
            backdrop-filter: blur(12px);
            color: white;
            max-width: 100%;
            width: 100%;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        @media (min-width: 768px) {
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


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const introVideo = document.getElementById("introVideo");
            const registrationForm = document.getElementById("registrationForm");

            // Hide intro video and show form on video end or click
            function showForm() {
                introVideo.style.display = "none";
                registrationForm.style.display = "block";
            }

            introVideo.addEventListener("ended", showForm);
            introVideo.addEventListener("click", showForm);
        });
    </script>

@endsection
