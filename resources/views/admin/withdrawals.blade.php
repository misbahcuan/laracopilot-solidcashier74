<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawals - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-gray-800 border-r border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-blue-400 mb-8">🔐 Admin Panel</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">📊 Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">👥 Users</a>
                    <a href="{{ route('admin.deposits') }}" class="block px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white">💳 Deposits</a>
                    <a href="{{ route('admin.withdrawals') }}" class="block px-4 py-3 rounded-lg bg-blue-600 text-white">💸 Withdrawals</a>
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
                <h1 class="text-2xl font-bold text-white">Withdrawal Management</h1>
            </header>

            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4 rounded-lg">{{ session('success') }}</div>
                @endif

                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4">All Withdrawals</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">After Fee</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Wallet Address</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td class="px-6 py-4 text-white">#{{ $withdrawal->id }}</td>
                                        <td class="px-6 py-4 text-white">{{ $withdrawal->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-red-400">${{ number_format($withdrawal->amount, 2) }}</td>
                                        <td class="px-6 py-4 text-green-400">${{ number_format($withdrawal->amount * 0.9, 2) }}</td>
                                        <td class="px-6 py-4 text-gray-400 text-xs font-mono">{{ substr($withdrawal->wallet_address, 0, 20) }}...</td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs px-3 py-1 rounded-full {{ $withdrawal->status === 'completed' ? 'bg-green-500/20 text-green-400' : ($withdrawal->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                                {{ ucfirst($withdrawal->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400">{{ $withdrawal->created_at->format('M d, Y h:i A') }}</td>
                                        <td class="px-6 py-4">
                                            @if($withdrawal->status === 'pending')
                                                <div class="flex space-x-2">
                                                    <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-500 text-sm">✓ Approve</button>
                                                    </form>
                                                    <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500 text-sm">✗ Reject</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-sm">{{ ucfirst($withdrawal->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $withdrawals->links() }}</div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
