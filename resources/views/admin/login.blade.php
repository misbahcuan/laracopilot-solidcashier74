<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FutureTrade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">🔐 Admin Panel</h1>
            <p class="text-gray-400">FutureTrade Administration</p>
        </div>

        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-lg p-8">
            @if($errors->any())
                <div class="mb-6 bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-semibold mb-2">Admin Email</label>
                    <input type="email" name="email" class="w-full bg-gray-800/50 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-blue-500 focus:outline-none" required autofocus>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-gray-800/50 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-blue-500 focus:outline-none" required>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-300">
                    🔓 Login to Admin Panel
                </button>
            </form>

            <div class="mt-6 bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
                <p class="text-blue-400 text-sm font-semibold mb-2 text-center">🔑 Admin Credentials</p>
                <div class="text-gray-300 text-xs space-y-1">
                    <p><strong>Email:</strong> admin@futuretrade.com</p>
                    <p><strong>Password:</strong> admin123</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
