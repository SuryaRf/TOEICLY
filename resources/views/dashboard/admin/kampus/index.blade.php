@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-purple-700">Daftar Kampus</h1>

    <div class="mb-4">
        <button id="btnTambah" class="btn btn-primary">Tambah Kampus</button>
    </div>

    <table id="kampusTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Kampus</th>
                <th>Nama Kampus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal kosong, bisa Anda isi dengan konten AJAX -->
<div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalContent">
      <!-- Konten AJAX akan dimuat di sini -->
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        var table = $('#kampusTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("kampus.list") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'kampus_kode', name: 'kampus_kode' },
                { data: 'kampus_nama', name: 'kampus_nama' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
            ]
        });

        // Fungsi untuk load modal dengan konten AJAX
        window.modalAction = function(url) {
            $('#modalContent').html('<div class="p-5 text-center">Loading...</div>');
            $('#modalAction').modal('show');

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#modalContent').html(response);
                },
                error: function() {
                    $('#modalContent').html('<div class="p-5 text-center text-danger">Gagal memuat data.</div>');
                }
            });
        };

        // Tombol tambah kampus
        $('#btnTambah').click(function() {
            modalAction('{{ url("kampus/create_ajax") }}');
        });
    });
</script>
@endsection
