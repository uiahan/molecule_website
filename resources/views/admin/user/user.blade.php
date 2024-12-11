@extends('layout.master')
@section('title', 'User')
@section('content')
    <div class="d-flex">
        @include('components.sidebar')
        <div class="container mt-4 mt-md-5 py-5">
            <div class="p-4 shadow card border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="fw-bold text-secondary">User</h3>
                    </div>
                    <div class="col-6">
                        <p class="text-muted text-end text-secondary">User &gt; Home</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 mt-4 p-4 shadow">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="me-auto text-secondary" style="color: #5692F9">Tabel User
                    </div>
                    <div class="col-md-8 d-flex justify-content-end d-none d-xl-block">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('tambahUser') }}" class="btn ms-2 rounded-4 text-white btn-kuning"
                                style="background-color: #edbb05">
                                <i class="me-1 fa-solid fa-plus"></i> Tambah User
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 d-block d-xl-none">
                        <div>
                            <a href="{{ route('tambahUser') }}" class="btn mt-1 w-100 rounded-4 text-white btn-kuning"
                                style="background-color: #edbb05">
                                <i class="me-1 fa-solid fa-plus"></i> Tambah User
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive pb-2">
                    <table class="table" id="example">
                        <thead style="background-color: #f2f2f2">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f2f2f2">
                            @foreach ($userr as $item)
                                <tr>
                                    <td style="vertical-align: middle;" scope="row">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;"><img src="{{ asset($item->photo) }}" class=" rounded-circle" width="40" height="40" style="object-fit: cover" alt=""></td>
                                    <td style="vertical-align: middle;">{{ $item->name }}</td>
                                    <td style="vertical-align: middle;">{{ $item->email }}</td>
                                    <td style="vertical-align: middle;">{{ $item->role }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="d-flex">
                                            <a href="{{ route('editUser', $item->id) }}" class="btn btn-success ms-1"
                                                style="padding: 12px 15px;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('resetpw', $item->id) }}" class="btn btn-primary ms-1"
                                                style="padding: 12px 15px;">
                                                <i class="fa-solid fa-key"></i>
                                            </a>
                                            <a href="{{ route('postHapusUser', $item->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn text-white ms-1 btn-merah"
                                                style="padding: 12px 15px; background-color:#d9261c;"
                                                >
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');

        console.log("Session Notification: {{ session('notif') }}");
    </script>
@endsection
<style>
    .toast {
        opacity: 1.0 !important;
        background-color: #00983d !important;
        padding: 15px 20px;
        margin: 10px;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .toast:hover {
        transform: scale(1.01);
    }

    .toast .toast-message {
        color: #ffffff;
    }

    @media (min-width: 768px) {
        .count-card {
            width: 50% !important;
        }
    }

    @media (min-width: 992px) {
        .count-card {
            width: 30% !important;
        }
    }

    .img-news {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    .content-shifted {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
    }

    .sidebar {
        width: 250px;
    }

    .btn-primary {
        -webkit-box-shadow: 0px 0px 5px 0px rgba(13, 109, 252, 1);
        -moz-box-shadow: 0px 0px 5px 0px rgba(13, 109, 252, 1);
        box-shadow: 0px 0px 5px 0px rgba(13, 109, 252, 1);
    }

    .btn-danger {
        -webkit-box-shadow: 0px 0px 5px 0px rgba(219, 53, 69, 1);
        -moz-box-shadow: 0px 0px 5px 0px rgba(219, 53, 69, 1);
        box-shadow: 0px 0px 5px 0px rgba(219, 53, 69, 1);
        Copy Text
    }

    .btn-success {
        -webkit-box-shadow: 0px 0px 5px 0px #00752f;
        -moz-box-shadow: 0px 0px 5px 0px #00752f;
        box-shadow: 0px 0px 5px 0px #00752f;
        Copy Text
    }
</style>
