<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Shelter Gym - Profesional Fitness</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div id="transition-overlay" class="fixed inset-0 bg-white z-[9999] opacity-0 pointer-events-none transition-opacity duration-500"></div>

<nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <!-- AREA KIRI: Tempat Logo berada -->
        <div class="flex items-center gap-2">
            <a href="#home" class="flex items-center gap-2 transition">
                <img src="/images/logo/logo.png" alt="Logo" class="h-8 w-auto object-contain">
                <!-- Jika ingin teks ShelterGym muncul lagi di sebelah logo, hapus comment di bawah ini -->
                <!-- <span class="text-2xl font-bold text-blue-600">ShelterGym</span> -->
            </a>
        </div>
        
        <!-- AREA TENGAH/KANAN: Menu Navigasi -->
        <div class="hidden md:flex gap-8 font-medium items-center">
            <a href="#home" class="hover:text-blue-600 transition">Home</a>
            <a href="#about" class="hover:text-blue-600 transition">About</a>
            <a href="#facilities" class="hover:text-blue-600 transition">Fasilitas</a>
            <a href="#pricing" class="hover:text-blue-600 transition">Pricing</a>
            <a href="#contact" class="hover:text-blue-600 transition">Contact</a>
        </div>

        <!-- AREA KANAN: Tombol Masuk -->
        <a href="{{ route('login') }}" onclick="transitionToLogin(event, this.href)" class="bg-blue-600 text-white px-6 py-2 rounded-full ...">
            Masuk
        </a>
    </div>
</nav>

    <section id="home" class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1">
                <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-bold">The real workout starts when you want to stop</span>
                <h1 class="text-5xl md:text-6xl font-extrabold mt-6 leading-tight">
                    Bangun Tubuh Ideal di <span class="text-blue-600">Shelter Gym</span>
                </h1>
                <p class="text-gray-600 mt-6 text-lg">
                    Fasilitas lengkap, trainer berpengalaman, dan komunitas yang suportif untuk membantu mencapai goals fitness Anda.
                </p>
                <div class="mt-10 flex gap-4">
                    <a href="#pricing" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:shadow-xl transition">Ambil Promo</a>
                    <a href="#about" class="border-2 border-gray-200 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition">Tentang Kami</a>
                </div>
            </div>
<div class="flex-1">
    <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format&fit=crop" alt="Gym Hero Image" class="w-full rounded-2xl shadow-2xl object-cover h-[400px]">
</div>
        </div>
    </section>

    <section id="about" class="py-24 bg-white px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold">Tentang Kami</h2>
            <p class="mt-4 text-gray-600">Di Shelter Gym, kami percaya bahwa kebugaran bukan sekadar tentang penampilan fisik, melainkan sebuah perjalanan menuju kualitas hidup yang lebih baik. Kami menyediakan fasilitas modern dengan peralatan standar tinggi, serta didukung oleh tim pelatih profesional yang siap mendampingi setiap langkah Anda. Di sini, Anda bukan hanya sekadar menjadi member, tetapi menjadi bagian dari komunitas yang saling mendukung, memotivasi, dan tumbuh bersama demi mencapai versi terbaik diri Anda.</p>
        </div>
    </section>

    <section id="facilities" class="py-24 bg-gray-50 px-6">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-bold">Fasilitas Shelter Gym</h2>
        <p class="mt-4 text-gray-600">Segala yang kamu butuhkan untuk latihan maksimal ada di sini.</p>
        
        <div class="grid md:grid-cols-4 gap-6 mt-12">
            <div class="p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4">💪</div>
                <h3 class="font-bold text-lg">Area Panco</h3>
                <p class="text-sm text-gray-500 mt-2">Tersedia meja panco khusus buat kamu yang ingin adu mekanik kekuatan tangan.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4">🥤</div>
                <h3 class="font-bold text-lg">Warung Sederhana</h3>
                <p class="text-sm text-gray-500 mt-2">Haus habis latihan? Tenang, ada warung buat beli air mineral, isotonik, atau sekadar istirahat.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4">🖼️</div>
                <h3 class="font-bold text-lg">Panduan Latihan</h3>
                <p class="text-sm text-gray-500 mt-2">Banyak poster panduan cara melatih otot Chest, Biceps, Triceps, dll biar latihanmu gak salah arah.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4">🏋️</div>
                <h3 class="font-bold text-lg">Alat Lengkap</h3>
                <p class="text-sm text-gray-500 mt-2">Berbagai macam beban dan alat fitness untuk mendukung progress latihanmu.</p>
            </div>
        </div>
    </div>
</section>

<section id="pricing" class="py-24 bg-white px-6">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-bold italic">PAKET MEMBER</h2>
        <p class="mt-4 text-gray-600 mb-12">Pilih paket yang paling pas buat kantong dan targetmu.</p>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- PAKET 1 BULAN -->
            <div class="border-2 border-gray-100 p-8 rounded-3xl hover:border-blue-600 transition group">
                <h3 class="font-bold text-xl text-gray-400 group-hover:text-blue-600">1 BULAN</h3>
                <p class="text-4xl font-black my-6">Rp 125.000</p>
                <ul class="text-gray-500 text-sm space-y-3 mb-8">
                    <li>Akses Full Fasilitas</li>
                    <li>Bebas Jam Latihan</li>
                    <li>Konsultasi Alat</li>
                </ul>
                <!-- Menggunakan tag <a> dengan tambahan block dan text-center agar penuh layaknya button -->
                <a href="{{ route('login') }}" class="block text-center w-full bg-gray-100 group-hover:bg-blue-600 group-hover:text-white py-3 rounded-xl font-bold transition">Pilih Paket</a>
            </div>

            <!-- PAKET 3 BULAN -->
            <div class="border-2 border-blue-600 p-8 rounded-3xl relative shadow-xl shadow-blue-100">
                <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-bold">BEST VALUE</span>
                <h3 class="font-bold text-xl text-blue-600">3 BULAN</h3>
                <p class="text-4xl font-black my-6">Rp 300.000</p>
                <ul class="text-gray-500 text-sm space-y-3 mb-8">
                    <li>Akses Full Fasilitas</li>
                    <li>Hemat Rp 75.000</li>
                    <li>Bebas Jam Latihan</li>
                </ul>
                <a href="{{ route('login') }}" class="block text-center w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">Pilih Paket</a>
            </div>

            <!-- PAKET 6 BULAN -->
            <div class="border-2 border-gray-100 p-8 rounded-3xl hover:border-blue-600 transition group">
                <h3 class="font-bold text-xl text-gray-400 group-hover:text-blue-600">6 BULAN</h3>
                <p class="text-4xl font-black my-6">Rp 500.000</p>
                <ul class="text-gray-500 text-sm space-y-3 mb-8">
                    <li>Akses Full Fasilitas</li>
                    <li>Hemat Rp 250.000</li>
                    <li>Paling Hemat & Puas</li>
                </ul>
                <a href="{{ route('login') }}" class="block text-center w-full bg-gray-100 group-hover:bg-blue-600 group-hover:text-white py-3 rounded-xl font-bold transition">Pilih Paket</a>
            </div>
        </div>
    </div>
</section>

</section>

    <!-- SECTION HUBUNGI KAMI & LOKASI -->
    <section id="contact" class="py-24 bg-gray-50 px-6 border-t">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold">Kunjungi & Hubungi Kami</h2>
                <p class="mt-4 text-gray-600">Punya pertanyaan atau ingin langsung datang latihan? Kami tunggu kedatanganmu!</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-stretch">
                <div class="bg-white p-6 rounded-3xl shadow-sm flex flex-col h-full">
                    <div>
                        <div class="flex items-center gap-3 mb-4 text-blue-600">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                            <h3 class="font-bold text-xl text-gray-800">Lokasi Shelter Gym</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Jl. Raya Kodau, RT.003/RW.002, Jatimekar, Kec. Jatiasih, Kota Bks, Jawa Barat 17422
                        </p>
                    </div>

                    <div class="w-full h-[300px] rounded-2xl overflow-hidden shadow-inner relative mt-6">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7363403565554!2d106.924845!3d-6.298355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698b4b141dbc97%3A0x32dc39f3950b8e57!2sTHE%20SHELTER%20GYM!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            class="absolute top-0 left-0 w-full h-full border-0"
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm flex flex-col justify-between h-full">
                    <div>
                        <div class="flex items-center gap-3 mb-4 text-blue-600">
                            <i class="fa-solid fa-comments text-2xl"></i>
                            <h3 class="font-bold text-xl text-gray-800">Kontak Sosial</h3>
                        </div>
                        <p class="text-gray-600 text-sm mb-8 leading-relaxed">
                            Hubungi kami atau ikuti media sosial Shelter Gym untuk mendapatkan info promo terbaru dan tips workout harian.
                        </p>
                    </div>

                    <div class="space-y-4 mb-auto">
                        <a href="https://wa.me/628118843030" target="_blank" class="flex items-center justify-between p-4 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-2xl transition group">
                            <div class="flex items-center gap-4">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                                <div>
                                    <p class="text-xs text-emerald-600/70 font-normal">WhatsApp Chat</p>
                                    <p class="text-sm md:text-base">0811-8843-030</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold group-hover:translate-x-1 transition">→</span>
                        </a>

                        <a href="https://www.instagram.com/sheltergymoffc/" target="_blank" class="flex items-center justify-between p-4 bg-pink-50 hover:bg-pink-100 text-pink-700 font-semibold rounded-2xl transition group">
                            <div class="flex items-center gap-4">
                                <i class="fa-brands fa-instagram text-2xl"></i>
                                <div>
                                    <p class="text-xs text-pink-600/70 font-normal">Instagram</p>
                                    <p class="text-sm md:text-base">sheltergymoffc</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold group-hover:translate-x-1 transition">→</span>
                        </a>

                        <a href="https://www.tiktok.com/@shelter.gym" target="_blank" class="flex items-center justify-between p-4 bg-gray-900 hover:bg-black text-white font-semibold rounded-2xl transition group">
                            <div class="flex items-center gap-4">
                                <i class="fa-brands fa-tiktok text-2xl"></i>
                                <div>
                                    <p class="text-xs text-gray-400 font-normal">TikTok</p>
                                    <p class="text-sm md:text-base">sheltergym</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold group-hover:translate-x-1 transition">→</span>
                        </a>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 text-center md:text-left">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-bold">Jam Operasional</p>
                        <div class="flex items-center justify-center md:justify-start gap-2 text-sm text-gray-600 mt-1">
                            <i class="fa-regular fa-clock text-blue-600"></i>
                            <p>Senin - Minggu: Buka 24 Jam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 text-center text-gray-400 border-t">
        &copy; 2026 Shelter Gym. All rights reserved.
    </footer>
<script>
function transitionToLogin(e, href) {
    e.preventDefault(); // Tahan dulu pindah halamannya
    const overlay = document.getElementById('transition-overlay');
    overlay.classList.remove('opacity-0');
    overlay.classList.add('opacity-100'); // Layar jadi putih halus

    setTimeout(() => {
        window.location.href = href; // Baru pindah setelah 500ms
    }, 500);
}
</script>
</body>
</html>
