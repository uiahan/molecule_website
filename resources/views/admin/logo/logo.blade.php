@extends('layout.master')
@section('title', 'Logo')
@section('content')
    <div class="d-flex">
        @include('components.sidebar')
        <div class="container mt-4 mt-md-5 py-5">
            <div class="p-4 shadow card border-0">
                <div class="row">
                    <div class="col-6">
                        <h3 class="fw-bold text-secondary">Logo</h3>
                    </div>
                    <div class="col-6">
                        <p class="text-muted text-end text-secondary">Logo &gt; Home</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 mt-4 p-4 shadow">
                <div class="d-md-flex">
                    <h4 class="me-auto" style="color: #5692F9">Ubah Logo</h4>
                </div>
                <hr>
                <div>
                    <div>
                        @foreach ($logo as $item)
                            <img src="{{ asset('img/'.$item->img) }}" width="311" class=" rounded-3" alt="">
                        </div>
                        <form action="{{ route('logoEdit', $item->id) }}" method="POST" class=" form-group" enctype="multipart/form-data">
                            @csrf
                        <div class="mt-3 col-3">
                                <input class=" form-control" type="file" name="img" id="img" style="background-color: #f2f2f2">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>    
                        @endforeach
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
