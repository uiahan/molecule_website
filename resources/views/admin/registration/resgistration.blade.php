@extends('layout.master')
@section('title', 'List Registrasi')
@section('content')
    <div class="d-flex">
        @include('components.sidebar')
        <div class="container mt-4 mt-md-5 py-5">
            <div class="p-4 shadow card border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="fw-bold text-secondary">Registrasi</h3>
                    </div>
                    <div class="col-6">
                        <p class="text-muted text-end text-secondary">Registrasi &gt; Home</p>
                    </div>
                </div>
            </div>

            <div class="card card-nasabah count-card border-0 mt-4 shadow" style="background-color: #5692F9">
                <div class="row px-3 py-4">
                    <div class="col-7 text-white">
                        <h5>Total Registrasi:</h5>
                        <h1 class="px-3">{{ $registrationcount }}</h1>
                    </div>
                    <div class="col-5 d-flex align-items-center" style="height: 100%;">
                        <i class='bx bx-pen nav_icon text-white' style="font-size: 5rem"></i>
                    </div>
                </div>
            </div>

            <div class="card border-0 mt-4 p-4 shadow">
                <div class="d-md-flex">
                    <h4 class="me-auto" style="color: #5692F9">Tabel Registrasi</h4>
                    <a href="{{ route('registrations.export') }}" class="btn btn-success ms-auto rounded-4">
                        <i class="bx bx-file me-1"></i>Export Excel
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <form id="bulk-delete-form" action="{{ route('registrations.bulk-delete') }}" method="POST"
                        class="d-none">
                        @csrf
                        <input type="hidden" name="ids" id="bulk-delete-ids">
                    </form>
                    <form id="bulk-send-emails-form" action="{{ route('registrations.bulk-send-emails') }}" method="POST"
                        class="d-none">
                        @csrf
                        <input type="hidden" name="ids" id="bulk-send-ids">
                    </form>
                    <form id="bulk-send-whatsapp-form" action="{{ route('registrations.bulk-send-whatsapp') }}"
                        method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="ids" id="bulk-whatsapp-ids">
                    </form>
                    <div class="mb-3 bulk-actions d-none">
                        <button id="bulk-delete" class="btn btn-danger">Hapus Terpilih</button>
                        <button id="bulk-send-emails" class="btn btn-primary">Kirim QR Email Terpilih</button>
                        <button id="bulk-send-qr-to-whatsapp" class="btn btn-primary">Kirim QR WhatsApp Terpilih</button>
                    </div>
                    <table class="table" id="example">
                        <thead style="background-color: #f2f2f2">
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" id="select-all">
                                </th>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Perusahaan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Akan Hadir</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f2f2f2">
                            @foreach ($registration as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="registration-checkbox" value="{{ $item->id }}">
                                    </td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->peserta }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->akan_hadir }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->unique_fields['jurusan'] ?? 'N/A' }}</td>
                                    <td>{{ $item->unique_fields['umur'] ?? 'N/A' }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        @if ($user->role == 'superadmin')
                                            <a href="{{ route('editRegistration', $item->id) }}"
                                                class="btn btn-primary mx-1" style="padding: 12px 15px;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('delete', $item->id) }}"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data peserta ini?');"
                                                class="btn btn-danger mx-1" style="padding: 12px 15px;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('downloadQrCode', $item->id) }}" class="btn btn-success mx-1"
                                            style="padding: 12px 15px;">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
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


        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.registration-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        document.getElementById('bulk-delete').addEventListener('click', function() {
            const selected = Array.from(document.querySelectorAll('.registration-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selected.length > 0 && confirm('Apakah Anda yakin ingin menghapus data peserta ini?')) {
                document.getElementById('bulk-delete-ids').value = selected.join(',');
                document.getElementById('bulk-delete-form').submit();
            } else {
                alert('Silakan pilih peserta yang ingin dihapus.');
            }
        });

        document.getElementById('bulk-send-emails').addEventListener('click', function() {
            const selected = Array.from(document.querySelectorAll('.registration-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selected.length > 0) {
                document.getElementById('bulk-send-ids').value = selected.join(',');
                document.getElementById('bulk-send-emails-form').submit();
            } else {
                alert('Silakan pilih peserta yang ingin dikirim email.');
            }
        });

        document.getElementById('bulk-send-qr-to-whatsapp').addEventListener('click', function() {
            const selected = Array.from(document.querySelectorAll('.registration-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selected.length > 0) {
                const confirmed = confirm('Apakah Anda yakin ingin mengirim QR code ke WhatsApp peserta terpilih?');
                if (confirmed) {
                    // Create a hidden form to send the selected IDs
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('registrations.bulk-send-whatsapp') }}';
                    form.innerHTML = `
                @csrf
                <input type="hidden" name="ids" value="${selected.join(',')}">
            `;
                    document.body.appendChild(form);
                    form.submit();
                }
            } else {
                alert('Silakan pilih peserta yang ingin dikirim QR code ke WhatsApp.');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.registration-checkbox');
            const bulkActionsDiv = document.querySelector('.bulk-actions');
            const selectAllCheckbox = document.getElementById('select-all');

            function updateBulkActions() {
                const isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                if (isAnyChecked) {
                    bulkActionsDiv.classList.remove('d-none');
                } else {
                    bulkActionsDiv.classList.add('d-none');
                }
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActions);
            });

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                updateBulkActions();
            });

            updateBulkActions();
        });
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
