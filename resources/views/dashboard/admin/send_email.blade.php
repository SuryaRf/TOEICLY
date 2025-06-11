<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email - TOEICLY Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    @include('dashboard.admin.sidebar')

    <main class="main-content ml-[15.5rem] p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Send Email</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.send_email.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="certificate_request_id" class="block text-gray-700 font-bold mb-2">Select Certificate
                    Request</label>
                <select name="certificate_request_id" id="certificate_request_id" class="w-full p-2 border rounded"
                    required>
                    <option value="">Select a request</option>
                    @foreach($pendingRequests as $request)
                        @if($request->pendaftaran && $request->pendaftaran->mahasiswa && $request->pendaftaran->mahasiswa->user && $request->pendaftaran->mahasiswa->user->email)
                            <option value="{{ $request->id }}">{{ $request->pendaftaran->mahasiswa->nama ?? 'Unknown' }} -
                                {{ $request->pendaftaran->jadwal->judul ?? 'No Schedule' }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="subject" class="block text-gray-700 font-bold mb-2">Subject</label>
                <input type="text" name="subject" id="subject" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
                <textarea name="message" id="message" class="w-full p-2 border rounded" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label for="attachment" class="block text-gray-700 font-bold mb-2">Upload Certificate (PDF, max
                    2MB)</label>
                <input type="file" name="attachment" id="attachment" class="w-full p-2 border rounded" accept=".pdf"
                    required>
            </div>
            <button type="submit" class="bg-purple-600 text-white p-2 rounded hover:bg-purple-700">Send Email</button>
        </form>
    </main>
</body>

</html>