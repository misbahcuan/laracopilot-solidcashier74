<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-gray-800 border-r border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-blue-400 mb-8">🔐 Admin Panel</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">📊 Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="block px-4 py-3 rounded-lg bg-blue-600 text-white">👥 Users</a>
                    <a href="{{ route('admin.deposits') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">💳 Deposits</a>
                    <a href="{{ route('admin.withdrawals') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">💸 Withdrawals</a>
                </nav>
            </div>
            <div class="absolute bottom-6 left-6 right-6">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10">🚪 Logout</button>
                </form>
            </div>
        </aside>

        <div class="flex-1 overflow-y-auto">
            <header class="bg-gray-800 border-b border-gray-700 px-8 py-4">
                <h1 class="text-2xl font-bold text-white">User Management</h1>
            </header>

            <main class="p-8">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4">All Users</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Username</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Balance</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">NXT Tokens</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-white">#{{ $user->id }}</td>
                                        <td class="px-6 py-4 text-white">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $user->username }}</td>
                                        <td class="px-6 py-4 text-green-400">${{ number_format($user->balance, 2) }}</td>
                                        <td class="px-6 py-4 text-yellow-400">{{ number_format($user->nxt_tokens) }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
