<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'TOEIC Management')</title>
    <!-- Include Tailwind CSS or Bootstrap if needed -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        @yield('content')
    </div>
</body>
</html>
