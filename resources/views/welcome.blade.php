<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Brokker Barbershop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121212] text-white font-sans scroll-smooth">

    <!-- NAVBAR (Sticky agar tetap ikut saat di scroll) -->
    <nav class="sticky top-0 z-50 bg-[#121212]/90 backdrop-blur-sm flex items-center justify-between px-12 py-6 border-b border-[#EAB308]">
        <div class="text-[#EAB308] text-2xl font-bold italic">Mr. Brokker</div>
        <div class="hidden md:flex space-x-8 text-sm font-medium">
            <a href="#home" class="hover:text-[#EAB308]">Home</a>
            <a href="#layanan" class="hover:text-[#EAB308]">Layanan</a>
            <a href="#galeri" class="hover:text-[#EAB308]">Galeri</a>
            <a href="#booking" class="hover:text-[#EAB308]">Booking</a>
            <a href="#testimoni" class="hover:text-[#EAB308]">Cek Status</a>
            <a href="#kontak" class="hover:text-[#EAB308]">Alamat</a>
        </div>
        <div class="flex space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm border border-[#EAB308] px-4 py-2 rounded text-[#EAB308]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-white px-4 py-2">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm bg-[#EAB308] text-black px-4 py-2 rounded font-bold">Daftar</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- SECTION 1: HERO (image_1c4314.png) -->
    <section id="home" class="min-h-screen flex flex-col items-center justify-center text-center px-4">
        <h1 class="text-[#EAB308] text-5xl md:text-6xl font-bold mb-6 italic">Selamat Datang di Mr. Brokker Barbershop</h1>
        <p class="text-gray-300 text-lg mb-10 max-w-2xl">Gaya maskulin, presisi, dan elegan untuk pria sejati.</p>
        <a href="{{ route('register') }}" class="bg-[#EAB308] text-black font-bold py-4 px-10 rounded-full text-xl hover:scale-105 transition shadow-[0_0_20px_rgba(234,179,8,0.3)]">
            Reservasi Sekarang
        </a>
    </section>

    <!-- SECTION 2: KENAPA MEMILIH KAMI -->
    <section class="py-24 bg-[#181818] text-center">
        <h2 class="text-[#EAB308] text-4xl font-bold mb-16">Kenapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-12 max-w-7xl mx-auto">
            <div class="border border-[#EAB308] p-10 rounded-[30px] hover:bg-[#1c1c1c] transition">
                <h3 class="text-[#EAB308] text-xl font-bold mb-4">Profesional & Berpengalaman</h3>
                <p class="text-gray-400 text-sm">Stylist berpengalaman yang ahli berbagai gaya rambut.</p>
            </div>
            <div class="border border-[#EAB308] p-10 rounded-[30px] hover:bg-[#1c1c1c] transition">
                <h3 class="text-[#EAB308] text-xl font-bold mb-4">Layanan Cepat & Tepat</h3>
                <p class="text-gray-400 text-sm">Reservasi online dan layanan cepat, tidak perlu menunggu lama.</p>
            </div>
            <div class="border border-[#EAB308] p-10 rounded-[30px] hover:bg-[#1c1c1c] transition">
                <h3 class="text-[#EAB308] text-xl font-bold mb-4">Suasana Nyaman</h3>
                <p class="text-gray-400 text-sm">Tempat bersih & nyaman untuk pengalaman terbaik saat potong rambut.</p>
            </div>
        </div>
    </section>

    <!-- SECTION 3: LAYANAN & HARGA -->
    <section id="layanan" class="py-24 text-center">
        <h2 class="text-4xl font-bold mb-16">Layanan <span class="text-[#EAB308]">& Harga</span></h2>
        <div class="max-w-3xl mx-auto space-y-6 px-6">
            <div class="flex justify-between items-center border border-[#EAB308] px-8 py-4 rounded-full bg-[#1c1c1c]">
                <span class="font-bold">Potong Rambut</span>
                <span class="text-[#EAB308] font-bold">30K</span>
            </div>
            <div class="flex justify-between items-center border border-[#EAB308] px-8 py-4 rounded-full bg-[#1c1c1c]">
                <span class="font-bold">Potong Rambut + Keramas</span>
                <span class="text-[#EAB308] font-bold">35K</span>
            </div>
            <div class="flex justify-between items-center border border-[#EAB308] px-8 py-4 rounded-full bg-[#1c1c1c]">
                <span class="font-bold">Cukur Kumis + Jenggot</span>
                <span class="text-[#EAB308] font-bold">10K</span>
            </div>
            <button class="mt-8 border border-gray-600 px-8 py-2 text-sm text-gray-400 hover:border-[#EAB308] hover:text-white transition">Learn More</button>
        </div>
    </section>

    <!-- SECTION 4: GALERI (image_1c3f2d.png) -->
    <section id="galeri" class="py-24 bg-[#181818] text-center">
        <h2 class="text-[#EAB308] text-4xl font-bold mb-16">Galeri Kami</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 px-12 max-w-7xl mx-auto">
            <!-- Placeholder gambar -->
            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                <img src="https://via.placeholder.com/300" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                <img src="https://via.placeholder.com/300" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                <img src="https://via.placeholder.com/300" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                <img src="https://via.placeholder.com/300" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                <img src="https://via.placeholder.com/300" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- SECTION 5: TESTIMONI -->
    <section id="testimoni" class="py-24 text-center">
        <h2 class="text-4xl font-bold mb-16"><span class="text-[#EAB308]">Testimoni</span> Pelanggan</h2>
        <div class="flex flex-wrap justify-center gap-6 px-6">
            <div class="bg-[#1c1c1c] border border-gray-700 p-6 rounded-xl max-w-xs">
                <p class="text-sm italic text-gray-300">"Pelayanan sangat ramah dan potongannya rapi!"</p>
                <p class="text-[#EAB308] mt-4 font-bold">- Andi</p>
            </div>
            <div class="bg-[#1c1c1c] border border-gray-700 p-6 rounded-xl max-w-xs">
                <p class="text-sm italic text-gray-300">"Reservasi online cepat, tidak perlu antre lama."</p>
                <p class="text-[#EAB308] mt-4 font-bold">- Rusdi</p>
            </div>
        </div>
    </section>

    <!-- SECTION 6: KONTAK & LOKASI -->
    <footer id="kontak" class="py-24 bg-[#181818] px-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-8">Kontak <span class="text-[#EAB308]">& Lokasi</span></h2>
                <h3 class="text-xl font-bold mb-4">Contact</h3>
                <p class="text-gray-400 leading-relaxed">
                    Jalan Pantai Kedungu No 13, Nyitdah,<br>
                    Kec. Kediri Kabupaten Tabanan,<br>
                    Bali 82121<br>
                    Telp: 0822-8824-0948
                </p>
            </div>
            <div class="h-64 bg-gray-700 rounded-xl overflow-hidden border-2 border-[#EAB308]">
                <!-- Placeholder Map -->
                <div class="w-full h-full flex items-center justify-center italic text-gray-400">Google Maps Barbershop</div>
            </div>
        </div>
        <p class="text-center text-gray-600 text-xs mt-20">© 2026 Barbershop Bali. All Rights Reserved.</p>
    </footer>

</body>
</html>