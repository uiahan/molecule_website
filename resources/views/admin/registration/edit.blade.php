@extends('layout.master')
@section('title', 'Edit Registrasi')
@section('content')
    <div class="d-flex">
        @include('components.sidebar')
        <div class="container mt-4 mt-md-5 py-5" id="printableArea">
            <div class="p-4 shadow card border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="fw-bold text-secondary">Edit Registrasi</h3>
                    </div>
                    <div class="col-6">
                        <p class="text-muted text-end text-secondary">Registrasi &gt; Edit</p>
                    </div>
                </div>
            </div>

            <div class="card p-4 shadow border-0 mt-4" >
                <h5 class="fw-bold text-secondary">Detail Registrasi Farhan Dika</h5>
                <div class="mt-3">
                    <div>
                        <a href="" class="btn {{ $registration->telah_scan == 'Sudah Scan' ? 'btn-success' : 'btn-danger' }}">
                            {{ $registration->telah_scan }}
                        </a>    
                    </div>
                    <div class="mt-2">
                        @if ($registration->telah_scan == 'Belum Scan')
                            <a href="{{ route('setHadir', $registration->id) }}" class="btn btn-primary">Set menjadi Hadir</a>
                        @else
                            <a href="{{ route('setTidakHadir', $registration->id) }}" class="btn btn-primary">Set menjadi Tidak Hadir</a>
                        @endif
                        <a href="{{ route('downloadQrCode', $registration->id) }}" class="btn btn-primary">Download QR</a>
                    </div>
                </div>
                <hr>
                <form action="{{ route('postEditRegistration', $registration->id) }}" method="POST" class="mt-2">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-12 mt-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="peserta" value="{{ $registration->peserta }}" class="form-control border-0" style="background-color: #ededed">
                        </div>
                        <div class="col-xl-6 col-12 mt-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" value="{{ $registration->email }}" class="form-control border-0" style="background-color: #ededed">
                        </div>
                        <div class="col-xl-6 col-12 mt-3">
                            <label for="" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama" value="{{ $registration->nama }}" class="form-control border-0" style="background-color: #ededed">
                        </div>
                        <div class="col-xl-6 col-12 mt-3">
                            <label for="" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ $registration->jabatan }}" class="form-control border-0" style="background-color: #ededed">
                        </div>
                        <div class="col-xl-6 col-12 mt-3">
                            <label for="" class="form-label">Nomor WA Aktif</label>
                            <input type="text" name="no_hp" value="{{ $registration->no_hp }}" class="form-control border-0" style="background-color: #ededed">
                        </div>
                        <div class="col-xl-6 col-12 mt-3">
                            <label for="" class="form-label">Domisili Perusahaan</label>
                            <input type="text" name="domisili_perusahaan" value="{{ $registration->domisili_perusahaan }}" class="form-control border-0" style="background-color: #ededed">
                        </div>
                        <div class="col-xl-6 col-12 mt-3">
                            <label class="form-label">Akan Hadir</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="akan_hadir" id="Iya" value="Iya" {{ $registration->akan_hadir == 'Iya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="Iya">Iya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="akan_hadir" id="Tidak" value="Tidak" {{ $registration->akan_hadir == 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="Tidak">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('registration') }}" class="btn btn-primary mt-3">Kembali</a>
                </form>                
            </div>       
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endsection


