<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposits - Admin Panel</title>
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
                    <a href="{{ route('admin.deposits') }}" class="block px-4 py-3 rounded-lg bg-blue-600 text-white">💳 Deposits</a>
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
                <h1 class="text-2xl font-bold text-white">Deposit Management</h1>
            </header>

            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4 rounded-lg">{{ session('success') }}</div>
                @endif

                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4">All Deposits</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Method</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">TX ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($deposits as $deposit)
                                    <tr>
                                        <td class="px-6 py-4 text-white">#{{ $deposit->id }}</td>
                                        <td class="px-6 py-4 text-white">{{ $deposit->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-green-400">${{ number_format($deposit->amount, 2) }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $deposit->payment_method }}</td>
                                        <td class="px-6 py-4 text-gray-400 text-xs font-mono">{{ substr($deposit->transaction_id, 0, 20) }}...</td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs px-3 py-1 rounded-full {{ $deposit->status === 'completed' ? 'bg-green-500/20 text-green-400' : ($deposit->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                                {{ ucfirst($deposit->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400">{{ $deposit->created_at->format('M d, Y h:i A') }}</td>
                                        <td class="px-6 py-4">
                                            @if($deposit->status === 'pending')
                                                <form action="{{ route('admin.deposits.approve', $deposit->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-500 text-sm">✓ Approve</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 text-sm">{{ ucfirst($deposit->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $deposits->links() }}</div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
