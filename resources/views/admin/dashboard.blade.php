<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Mr. Brokker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(234,179,8,0.15); color: #EAB308; border-left: 3px solid #EAB308; }
        .stat-card { background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 16px; transition: all 0.3s; }
        .stat-card:hover { border-color: #EAB308; transform: translateY(-2px); }
    </style>
</head>
<body style="background:#0e0e0e; color:white;">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 shrink-0 flex flex-col" style="background:#111; border-right: 1px solid #222;">
        <!-- Logo -->
        <div class="px-6 py-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-[#EAB308] rounded-lg flex items-center justify-center shrink-0">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5"><path d="M6 3v18M18 3v18M6 7h12M6 17h12"/></svg>
                </div>
                <div>
                    <p class="text-white font-bold font-display text-sm">Mr. Brokker</p>
                    <p class="text-gray-500 text-xs">Panel Admin</p>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-4 space-y-1">
            <p class="text-gray-600 text-xs font-semibold uppercase tracking-wider px-3 mb-2">Menu Utama</p>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link active flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.reservations') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-400">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                Reservasi
            </a>
        </nav>

        <!-- User Info -->
        <div class="px-4 py-4 border-t border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#EAB308] flex items-center justify-center text-black font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-gray-500 text-xs truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left text-gray-500 text-xs hover:text-red-400 transition flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-auto">

        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-800 flex items-center justify-between" style="background:#111;">
            <div>
                <h1 class="text-xl font-bold font-display text-white">Dashboard</h1>
                <p class="text-gray-500 text-sm mt-0.5">Selamat datang, {{ auth()->user()->name }}!</p>
            </div>
            <div class="text-gray-500 text-sm">{{ now()->format('l, d F Y') }}</div>
        </div>

        <div class="px-8 py-8">

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-400 text-sm">Total Reservasi</p>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(234,179,8,0.15);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#EAB308" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white font-display">{{ $totalReservasi }}</p>
                    <p class="text-gray-500 text-xs mt-1">Semua waktu</p>
                </div>
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-400 text-sm">Menunggu</p>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(234,179,8,0.15);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#EAB308" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white font-display">{{ $pending }}</p>
                    <p class="text-gray-500 text-xs mt-1">Perlu ditindaklanjuti</p>
                </div>
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-400 text-sm">Dikonfirmasi</p>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(34,197,94,0.15);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white font-display">{{ $confirmed }}</p>
                    <p class="text-gray-500 text-xs mt-1">Berhasil dikonfirmasi</p>
                </div>
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-400 text-sm">Dibatalkan</p>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(239,68,68,0.15);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-white font-display">{{ $cancelled }}</p>
                    <p class="text-gray-500 text-xs mt-1">Reservasi dibatalkan</p>
                </div>
            </div>

            <!-- Recent Reservations -->
            <div class="stat-card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold font-display">Reservasi Terbaru</h2>
                    <a href="{{ route('admin.reservations') }}" class="text-[#EAB308] text-sm hover:underline">Lihat Semua →</a>
                </div>
                @php $recent = \App\Models\Reservation::latest()->take(5)->get(); @endphp
                @if($recent->isEmpty())
                    <div class="text-center py-12 text-gray-500">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mx-auto mb-3 opacity-40"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <p>Belum ada reservasi</p>
                    </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-800">
                                <th class="text-left text-gray-500 font-medium pb-3">Nama</th>
                                <th class="text-left text-gray-500 font-medium pb-3">Layanan</th>
                                <th class="text-left text-gray-500 font-medium pb-3">Tanggal</th>
                                <th class="text-left text-gray-500 font-medium pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach($recent as $r)
                            <tr>
                                <td class="py-3 text-white font-medium">{{ $r->name }}</td>
                                <td class="py-3 text-gray-400">{{ $r->service }}</td>
                                <td class="py-3 text-gray-400">{{ \Carbon\Carbon::parse($r->date)->format('d M Y') }}</td>
                                <td class="py-3">
                                    @if($r->status === 'confirmed')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#22c55e;">Dikonfirmasi</span>
                                    @elseif($r->status === 'cancelled')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:rgba(239,68,68,0.15);color:#ef4444;">Dibatalkan</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:rgba(234,179,8,0.15);color:#EAB308;">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </main>
</div>

</body>
</html>