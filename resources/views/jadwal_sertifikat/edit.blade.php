<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Certificate Schedule - TOEICLY Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main style="margin-left: 16rem; padding: 2.5rem; min-height: 100vh; overflow-y: auto;">
        <h1 class="main-title-purple">Edit Certificate Schedule</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jadwal_sertifikat.update', $jadwal->jadwal_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label">Schedule Name</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $jadwal->judul) }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Date</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
            </div>
            <div class="mb-3">
                <label for="file_pdf" class="form-label">PDF File (optional)</label>
                <input type="file" name="file_pdf" id="file_pdf" class="form-control">
                @if($jadwal->file_pdf)
                    <p class="text-muted mt-1">Current file: <a href="{{ asset('storage/' . $jadwal->file_pdf) }}" target="_blank">{{ basename($jadwal->file_pdf) }}</a></p>
                @endif
            </div>
            <button type="submit" class="btn-modern">Update Schedule</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>