<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Requests - TOEICLY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main class="main-content ml-[15.5rem] p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Certificate Requests</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead>
                    <tr class="bg-purple-600 text-white">
                        <th class="py-3 px-4 text-left">Student</th>
                        <th class="py-3 px-4 text-left">Registration Date</th>
                        <th class="py-3 px-4 text-left">Schedule</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $request->pendaftaran->mahasiswa->nama }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($request->pendaftaran->tanggal_pendaftaran)->format('d-m-Y') }}</td>
                            <td class="py-3 px-4">{{ $request->pendaftaran->jadwal->judul ?? 'N/A' }}</td>
                            <td class="py-3 px-4">
                                <span class="{{ $request->status === 'pending' ? 'text-yellow-600' : ($request->status === 'approved' ? 'text-green-600' : 'text-red-600') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @if($request->status === 'pending')
                                    <a href="{{ route('admin.approve_certificate', $request->id) }}" class="text-green-600 hover:underline mr-2">Approve</a>
                                    <a href="{{ route('admin.reject_certificate', $request->id) }}" class="text-red-600 hover:underline">Reject</a>
                                @endif
                                @if($request->file_path)
                                    <a href="{{ route('admin.download_certificate', $request->id) }}" class="text-blue-600 hover:underline">Download</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-4 text-center text-gray-500">No certificate requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>