<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email - TOEICLY Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
            color: #1f2937;
        }
        .sidebar-content {
            margin-left: 15.5rem;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar-content {
                margin-left: 0;
            }
        }
        .card {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input, .form-select, .form-textarea {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
            outline: none;
        }
        .form-error {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
        .submit-button {
            background: #7c3aed;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.2s ease, transform 0.2s ease;
        }
        .submit-button:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }
        .submit-button:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }
        .file-input {
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease;
        }
        .file-input:hover {
            border-color: #7c3aed;
        }
        .alert {
            border-radius: 0.5rem;
            padding: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }
        .status-buttons button {
            margin-right: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }
        .status-buttons .approved {
            background-color: #10b981;
            color: white;
        }
        .status-buttons .rejected {
            background-color: #ef4444;
            color: white;
        }
        .status-buttons .pending {
            background-color: #f59e0b;
            color: white;
        }
    </style>
</head>
<body>
    @include('dashboard.admin.sidebar')

    <div class="sidebar-content py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="card p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 sticky top-0 bg-white z-10">
                    <i class="fas fa-envelope mr-2 text-indigo-600"></i> Send Certificate Email
                </h2>

                @if (session('success'))
                    <div class="alert alert-success mb-6">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error mb-6">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @foreach ($pendingRequests as $request)
                    <div class="mb-6 p-4 border rounded-lg">
                        <h3 class="text-xl font-semibold">{{ $request->pendaftaran->mahasiswa->nama ?? 'Unknown' }}</h3>
                        <p><strong>Email:</strong> {{ $request->pendaftaran->mahasiswa->user->email ?? 'N/A' }}</p>
                        <p><strong>Request ID:</strong> {{ $request->id }}</p>
                        <p><strong>Status:</strong> 
                            <span class="px-2 py-1 rounded {{ $request->status === 'approved' ? 'approved' : ($request->status === 'rejected' ? 'rejected' : 'pending') }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </p>
                        <p><strong>Jadwal:</strong> {{ $request->pendaftaran->jadwal->judul ?? 'No Schedule' }}</p>

                        <div class="status-buttons mt-4">
                            @if ($request->status === 'pending')
                                <form action="{{ route('admin.send_email.update_status', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="approved">Approve</button>
                                </form>
                                <form action="{{ route('admin.send_email.update_status', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="rejected">Reject</button>
                                </form>
                            @endif
                        </div>

                        @if ($request->status === 'approved')
                            <form action="{{ route('admin.send_email.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4" id="email-form-{{ $request->id }}">
                                @csrf
                                <input type="hidden" name="certificate_request_id" value="{{ $request->id }}">

                                <div>
                                    <label for="subject-{{ $request->id }}" class="form-label">Subject</label>
                                    <input type="text" id="subject-{{ $request->id }}" name="subject" class="form-input w-full" required>
                                    @error('subject')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="message-{{ $request->id }}" class="form-label">Message</label>
                                    <textarea id="message-{{ $request->id }}" name="message" rows="6" class="form-textarea w-full" required placeholder="Enter your message here..."></textarea>
                                    @error('message')
                                        <p class="form-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="attachment-{{ $request->id }}" class="form-label">Attachment (PDF, max 2MB)</label>
                                    <div class="file-input">
                                        <input type="file" id="attachment-{{ $request->id }}" name="attachment" accept=".pdf" class="hidden" required>
                                        <p class="text-gray-500 text-sm">
                                            <i class="fas fa-upload mr-1"></i> Drag & drop or click to upload
                                        </p>
                                        <p id="file-name-{{ $request->id }}" class="text-gray-600 text-sm mt-2 hidden"></p>
                                    </div>
                                    @error('attachment')
                                        <p class="form-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="submit-button" id="submit-button-{{ $request->id }}">
                                        <span class="submit-text">Send Email</span>
                                        <span class="loading-text hidden">
                                            <i class="fas fa-spinner fa-spin mr-2"></i> Sending...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="mt-4 text-gray-500">Please approve the request before sending an email.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        @foreach ($pendingRequests as $request)
            const fileInput{{ $request->id }} = document.getElementById('attachment-{{ $request->id }}');
            const fileNameDisplay{{ $request->id }} = document.getElementById('file-name-{{ $request->id }}');
            const fileInputContainer{{ $request->id }} = fileInput{{ $request->id }}.parentElement;

            fileInputContainer{{ $request->id }}.addEventListener('dragover', (e) => e.preventDefault());
            fileInputContainer{{ $request->id }}.addEventListener('drop', (e) => {
                e.preventDefault();
                fileInput{{ $request->id }}.files = e.dataTransfer.files;
                updateFileName{{ $request->id }}();
            });
            fileInputContainer{{ $request->id }}.addEventListener('click', () => fileInput{{ $request->id }}.click());
            fileInput{{ $request->id }}.addEventListener('change', updateFileName{{ $request->id }});

            function updateFileName{{ $request->id }}() {
                if (fileInput{{ $request->id }}.files.length > 0) {
                    fileNameDisplay{{ $request->id }}.textContent = fileInput{{ $request->id }}.files[0].name;
                    fileNameDisplay{{ $request->id }}.classList.remove('hidden');
                } else {
                    fileNameDisplay{{ $request->id }}.classList.add('hidden');
                }
            }

            const form{{ $request->id }} = document.getElementById('email-form-{{ $request->id }}');
            const submitButton{{ $request->id }} = document.getElementById('submit-button-{{ $request->id }}');
            const submitText{{ $request->id }} = submitButton{{ $request->id }}.querySelector('.submit-text');
            const loadingText{{ $request->id }} = submitButton{{ $request->id }}.querySelector('.loading-text');

            form{{ $request->id }}.addEventListener('submit', () => {
                submitButton{{ $request->id }}.disabled = true;
                submitText{{ $request->id }}.classList.add('hidden');
                loadingText{{ $request->id }}.classList.remove('hidden');
            });
        @endforeach
    </script>
</body>
</html>