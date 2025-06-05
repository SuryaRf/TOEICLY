<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Information - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main class="ml-64 p-10 min-h-screen">
        <h1 class="text-4xl font-bold mb-6 text-purple-700">Manage Information</h1>

        @if(session('success'))
            <div class="alert alert-success mb-6">{{ session('success') }}</div>
        @endif

        <a href="{{ route('informasi.create') }}" class="btn btn-modern mb-6">Add New Information</a>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="table table-bordered table-striped w-full">
                <thead class="bg-purple-100 text-purple-700">
                    <tr>
                        <th class="p-3">No.</th>
                        <th class="p-3">Title</th>
                        <th class="p-3">Content</th>
                        <th class="p-3">Posted By</th>
                        <th class="p-3">Created At</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($informasis as $index => $informasi)
                        <tr>
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $informasi->judul }}</td>
                            <td class="p-3">{{ Str::limit($informasi->isi, 100) }}</td>
                            <td class="p-3">{{ $informasi->admin->nama ?? 'Unknown' }}</td>
                            <td class="p-3">{{ optional($informasi->created_at)->format('d-m-Y H:i') ?? '-' }}</td>
                            <td class="p-3">
                                <a href="{{ route('informasi.edit', $informasi->informasi_id) }}"
                                   class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('informasi.destroy', $informasi->informasi_id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this information?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">No information available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>