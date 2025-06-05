<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main class="ml-64 p-10 min-h-screen">
        <h1 class="text-4xl font-bold mb-6 text-purple-700">Edit Information</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('informasi.update', $informasi->informasi_id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="judul" class="form-label">Title</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $informasi->judul) }}" required>
            </div>
            <div class="mb-4">
                <label for="isi" class="form-label">Content</label>
                <textarea name="isi" id="isi" class="form-control" rows="6" required>{{ old('isi', $informasi->isi) }}</textarea>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="btn btn-modern">Update</button>
                <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>