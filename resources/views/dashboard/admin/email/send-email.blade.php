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
    </style>
</head>
<body>
    @include('dashboard.admin.sidebar')

    <div class="sidebar-content py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="card p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 sticky top-0 bg-white z-10">
                    <i class="fas fa-envelope mr-2 text-indigo-600"></i> Send Email to User
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

                <form action="{{ route('admin.send_email.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="email-form">
                    @csrf

                    <div>
                        <label for="user_id" class="form-label">Select User</label>
                        <select id="user_id" name="user_id" class="form-select w-full" required>
                            <option value="">-- Select a User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->username }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" rows="6" class="form-textarea w-full" required placeholder="Enter your message here..."></textarea>
                        @error('message')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="attachment" class="form-label">Attachment (PDF, JPG, PNG, DOC, DOCX, max 2MB)</label>
                        <div class="file-input">
                            <input type="file" id="attachment" name="attachment" accept=".pdf,.jpg,.png,.doc,.docx" class="hidden">
                            <p class="text-gray-500 text-sm">
                                <i class="fas fa-upload mr-1"></i> Drag & drop or click to upload
                            </p>
                            <p id="file-name" class="text-gray-600 text-sm mt-2 hidden"></p>
                        </div>
                        @error('attachment')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="submit-button" id="submit-button">
                            <span class="submit-text">Send Email</span>
                            <span class="loading-text hidden">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Sending...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // File input handling
        const fileInput = document.getElementById('attachment');
        const fileNameDisplay = document.getElementById('file-name');
        const fileInputContainer = fileInput.parentElement;

        fileInputContainer.addEventListener('dragover', (e) => e.preventDefault());
        fileInputContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            fileInput.files = e.dataTransfer.files;
            updateFileName();
        });
        fileInputContainer.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', updateFileName);

        function updateFileName() {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = fileInput.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            } else {
                fileNameDisplay.classList.add('hidden');
            }
        }

        // Form submission loading state
        const form = document.getElementById('email-form');
        const submitButton = document.getElementById('submit-button');
        const submitText = submitButton.querySelector('.submit-text');
        const loadingText = submitButton.querySelector('.loading-text');

        form.addEventListener('submit', () => {
            submitButton.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
        });
    </script>
</body>
</html>