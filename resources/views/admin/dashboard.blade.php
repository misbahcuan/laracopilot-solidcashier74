<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FutureTrade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 border-r border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-blue-400 mb-8">🔐 Admin Panel</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg bg-blue-600 text-white">📊 Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">👥 Users</a>
                    <a href="{{ route('admin.deposits') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">💳 Deposits <span class="ml-2 px-2 py-1 text-xs rounded-full bg-yellow-500 text-black">{{ $pendingDeposits }}</span></a>
                    <a href="{{ route('admin.withdrawals') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">💸 Withdrawals <span class="ml-2 px-2 py-1 text-xs rounded-full bg-yellow-500 text-black">{{ $pendingWithdrawals }}</span></a>
                </nav>
            </div>
            <div class="absolute bottom-6 left-6 right-6">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10">🚪 Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <header class="bg-gray-800 border-b border-gray-700 px-8 py-4">
                <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
                <p class="text-gray-400 text-sm mt-1">Platform overview and statistics</p>
            </header>

            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4 rounded-lg">{{ session('success') }}</div>
                @endif

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                        <div class="text-gray-400 text-sm mb-2">Total Users</div>
                        <div class="text-3xl font-bold text-white">{{ $totalUsers }}</div>
                    </div>
                    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                        <div class="text-gray-400 text-sm mb-2">Total Deposits</div>
                        <div class="text-3xl font-bold text-green-400">${{ number_format($totalDeposits, 2) }}</div>
                    </div>
                    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                        <div class="text-gray-400 text-sm mb-2">Total Withdrawals</div>
                        <div class="text-3xl font-bold text-red-400">${{ number_format($totalWithdrawals, 2) }}</div>
                    </div>
                    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                        <div class="text-gray-400 text-sm mb-2">Active Trades</div>
                        <div class="text-3xl font-bold text-blue-400">{{ $activeTrades }}</div>
                    </div>
                </div>

                <!-- Pending Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-800 border border-yellow-500 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-white mb-4">⏳ Pending Deposits ({{ $pendingDeposits }})</h3>
                        <a href="{{ route('admin.deposits') }}" class="block bg-yellow-500 text-black font-bold py-2 px-4 rounded-lg hover:bg-yellow-400 text-center">Review Deposits →</a>
                    </div>
                    <div class="bg-gray-800 border border-orange-500 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-white mb-4">⏳ Pending Withdrawals ({{ $pendingWithdrawals }})</h3>
                        <a href="{{ route('admin.withdrawals') }}" class="block bg-orange-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-400 text-center">Review Withdrawals →</a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4">📋 Recent Users</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Balance</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($recentUsers as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-white">#{{ $user->id }}</td>
                                        <td class="px-6 py-4 text-white">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-green-400">${{ number_format($user->balance, 2) }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
