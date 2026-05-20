<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Shelter Gym - Profesional Fitness</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        html{
            scroll-behavior: smooth;
        }

        body{
            overflow-x: hidden;
            background: #f8fafc;
        }

        /* ===== CUSTOM SCROLLBAR ===== */
        ::-webkit-scrollbar{
            width: 10px;
        }

        ::-webkit-scrollbar-track{
            background: #e2e8f0;
        }

        ::-webkit-scrollbar-thumb{
            background: linear-gradient(to bottom,#2563eb,#38bdf8);
            border-radius: 999px;
        }

        /* ===== NAVBAR EFFECT ===== */
        .sg-navbar-blur{
            backdrop-filter: blur(18px);
            background: rgba(255,255,255,0.75);
        }

        /* ===== HERO ANIMATION ===== */
        .sg-floating-animation{
            animation: sgFloat 4s ease-in-out infinite;
        }

        @keyframes sgFloat{
            0%{
                transform: translateY(0px);
            }
            50%{
                transform: translateY(-15px);
            }
            100%{
                transform: translateY(0px);
            }
        }

        /* ===== GLOW EFFECT ===== */
        .sg-glow-btn{
            position: relative;
            overflow: hidden;
        }

        .sg-glow-btn::before{
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.4);
            border-radius: 50%;
            top: -20px;
            left: -100px;
            transition: 0.6s;
        }

        .sg-glow-btn:hover::before{
            left: 120%;
        }

        /* ===== CARD EFFECT ===== */
        .sg-modern-card{
            transition: all .4s ease;
            position: relative;
            overflow: hidden;
        }

        .sg-modern-card::after{
            content: '';
            position: absolute;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right,#2563eb,#38bdf8);
            bottom: 0;
            left: -100%;
            transition: .4s;
        }

        .sg-modern-card:hover::after{
            left: 0;
        }

        .sg-modern-card:hover{
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(37,99,235,0.15);
        }

        /* ===== HERO GRADIENT ===== */
        .sg-hero-bg{
            background:
            radial-gradient(circle at top left, rgba(59,130,246,0.2), transparent 35%),
            radial-gradient(circle at bottom right, rgba(14,165,233,0.2), transparent 35%);
        }

        /* ===== IMAGE EFFECT ===== */
        .sg-image-hover{
            transition: 0.5s;
        }

        .sg-image-hover:hover{
            transform: scale(1.03) rotate(-1deg);
        }

        /* ===== FOOTER EFFECT ===== */
        .sg-footer-link{
            transition: .3s;
        }

        .sg-footer-link:hover{
            transform: translateX(5px);
            color: #60a5fa;
        }

        /* ===== SOCIAL ICON ===== */
        .sg-social-icon{
            transition: .3s;
        }

        .sg-social-icon:hover{
            transform: translateY(-6px) scale(1.1);
        }

        /* ===== MOBILE MENU ===== */
        .sg-mobile-menu{
            display: none;
        }

        @media(max-width:768px){
            .sg-mobile-menu{
                display: block;
            }

            .sg-desktop-menu{
                display: none;
            }

            .sg-mobile-dropdown{
                display: none;
            }

            .sg-mobile-dropdown.active{
                display: flex;
            }
        }
    </style>
</head>

<body class="text-gray-800">

<!-- ================= NAVBAR ================= -->
<nav class="fixed w-full z-50 sg-navbar-blur border-b border-white/20 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 md:py-4 flex justify-between items-center">

        <!-- LOGO -->
        <div class="flex items-center gap-3">
            <a href="#home" class="flex items-center gap-3">
                <img src="/images/logo/logo.png"
                     alt="Logo"
                     class="h-8 md:h-10 w-auto object-contain drop-shadow-lg">

                {{-- <div>
                    <h1 class="text-xl font-extrabold text-blue-600 leading-none">
                        Shelter Gym
                    </h1>
                    <p class="text-[11px] text-gray-500">
                        Professional Fitness
                    </p>
                </div> --}}
            </a>
        </div>

        <!-- MENU DESKTOP -->
        <div class="hidden md:flex gap-8 font-medium items-center sg-desktop-menu">
            <a href="#home" class="hover:text-blue-600 transition duration-300 hover:scale-105">
                Home
            </a>

            <a href="#about" class="hover:text-blue-600 transition duration-300 hover:scale-105">
                About
            </a>

            <a href="#facilities" class="hover:text-blue-600 transition duration-300 hover:scale-105">
                Fasilitas
            </a>

            <a href="#pricing" class="hover:text-blue-600 transition duration-300 hover:scale-105">
                Pricing
            </a>

            <a href="#contact" class="hover:text-blue-600 transition duration-300 hover:scale-105">
                Contact
            </a>
        </div>

        <!-- BUTTON -->
        <div class="flex items-center gap-4">

            <a href="{{ route('login') }}"
               class="sg-glow-btn bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-4 md:px-7 py-2 md:py-3 rounded-full text-sm md:text-base font-semibold shadow-lg hover:scale-105 transition duration-300">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                Masuk
            </a>

            <!-- MOBILE BUTTON -->
            <button id="sgMobileBtn"
                    class="sg-mobile-menu text-2xl text-blue-600">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="sgMobileMenu"
         class="sg-mobile-dropdown flex-col gap-5 px-6 pb-6 bg-white/95 backdrop-blur-xl md:hidden">

        <a href="#home" class="hover:text-blue-600">Home</a>
        <a href="#about" class="hover:text-blue-600">About</a>
        <a href="#facilities" class="hover:text-blue-600">Fasilitas</a>
        <a href="#pricing" class="hover:text-blue-600">Pricing</a>
        <a href="#contact" class="hover:text-blue-600">Contact</a>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section id="home"
         class="pt-28 md:pt-36 pb-16 md:pb-24 px-4 md:px-6 sg-hero-bg relative overflow-hidden">

    <!-- BLUR CIRCLE -->
    <div class="absolute w-72 h-72 bg-blue-400/20 rounded-full blur-3xl top-0 left-0"></div>
    <div class="absolute w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl bottom-0 right-0"></div>

    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-16 relative z-10">

        <!-- TEXT -->
        <div class="flex-1">

        <span class="hidden md:inline-block bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-sm font-bold shadow">
            The body achieves what the mind believes.
        </span>

            <h1 class="text-3xl sm:text-4xl md:text-7xl font-extrabold mt-6 leading-tight">
                Bangun Tubuh Ideal di
                <span class="bg-gradient-to-r from-blue-600 to-cyan-400 bg-clip-text text-transparent">
                    Shelter Gym
                </span>
            </h1>

            <p class="text-gray-600 mt-5 text-base md:text-lg leading-relaxed">
                Fasilitas lengkap, trainer profesional, dan komunitas fitness
                yang suportif untuk membantu mencapai goals impianmu.
            </p>

            <div class="mt-10 flex flex-wrap gap-4">

                <a href="#pricing"
                   class="sg-glow-btn bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-5 md:px-8 py-3 md:py-4 rounded-2xl text-sm md:text-base font-bold shadow-xl hover:scale-105 transition">
                    Ambil Promo
                </a>

                <a href="#about"
                   class="border-2 border-gray-200 bg-white px-8 py-4 rounded-2xl font-bold hover:bg-gray-100 transition hover:scale-105">
                    Tentang Kami
                </a>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-3 gap-3 md:gap-5 mt-10">

                <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-3 md:p-5 shadow">
                    <h2 class="text-xl md:text-3xl font-black text-blue-600">500+</h2>
                    <p class="text-sm text-gray-500 mt-1">Active Member</p>
                </div>

                <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-3 md:p-5 shadow">
                    <h2 class="text-xl md:text-3xl font-black text-blue-600">24H</h2>
                    <p class="text-sm text-gray-500 mt-1">Open Gym</p>
                </div>

                <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-3 md:p-5 shadow">
                    <h2 class="text-xl md:text-3xl font-black text-blue-600">100%</h2>
                    <p class="text-sm text-gray-500 mt-1">Motivation</p>
                </div>
            </div>
        </div>

        <!-- IMAGE -->
        <div class="hidden md:block flex-1 relative">

            <div class="absolute -top-6 -left-6 w-24 h-24 bg-blue-500 rounded-full blur-3xl opacity-30"></div>

            <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1200&auto=format&fit=crop"
                 alt="Gym Hero Image"
                 class="w-full rounded-[35px] shadow-2xl object-cover h-[500px] sg-floating-animation sg-image-hover">

            <!-- FLOATING CARD -->
            <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-xl p-5 rounded-2xl shadow-xl">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>

                    <div>
                        <h3 class="font-bold">Professional Gym</h3>
                        <p class="text-sm text-gray-500">Best Fitness Experience</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ================= ABOUT ================= -->
<section id="about" class="py-28 bg-white px-6">
    <div class="max-w-5xl mx-auto text-center">

        <span class="text-blue-600 font-bold uppercase tracking-widest">
            About Us
        </span>

        <h2 class="text-4xl md:text-3xl md:text-5xl font-black mt-4">
            Tempat Terbaik Untuk
            <span class="text-blue-600">Membangun Diri</span>
        </h2>

        <p class="mt-8 text-gray-600 leading-relaxed text-lg">
            Di Shelter Gym, kami percaya bahwa kebugaran bukan hanya tentang tubuh,
            tetapi tentang membangun disiplin, kepercayaan diri, dan gaya hidup sehat.
            Dengan fasilitas modern, alat berkualitas, serta komunitas yang suportif,
            kami siap menemani perjalanan fitness Anda setiap hari.
        </p>
    </div>
</section>

<!-- ================= FACILITIES ================= -->
<section id="facilities" class="py-28 bg-gray-50 px-6">

    <div class="max-w-7xl mx-auto text-center">

        <span class="text-blue-600 font-bold uppercase tracking-widest">
            Fasilitas
        </span>

        <h2 class="text-4xl font-black mt-4">
            Fasilitas Shelter Gym
        </h2>

        <p class="mt-4 text-gray-600">
            Semua kebutuhan latihanmu tersedia lengkap di sini.
        </p>

        <div class="grid md:grid-cols-4 gap-8 mt-16">

            <!-- CARD -->
            <div class="sg-modern-card bg-white rounded-3xl p-8 shadow-sm">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-blue-100 flex items-center justify-center text-4xl">
                    💪
                </div>

                <h3 class="font-bold text-xl mt-6">
                    Area Panco
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Area khusus buat kamu yang suka adu kekuatan tangan dan melatih grip power.
                </p>
            </div>

            <!-- CARD -->
            <div class="sg-modern-card bg-white rounded-3xl p-8 shadow-sm">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-cyan-100 flex items-center justify-center text-4xl">
                    🥤
                </div>

                <h3 class="font-bold text-xl mt-6">
                    Warung Sederhana
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Tersedia minuman segar dan tempat istirahat setelah workout.
                </p>
            </div>

            <!-- CARD -->
            <div class="sg-modern-card bg-white rounded-3xl p-8 shadow-sm">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-pink-100 flex items-center justify-center text-4xl">
                    🖼️
                </div>

                <h3 class="font-bold text-xl mt-6">
                    Panduan Latihan
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Poster latihan otot lengkap untuk membantu teknik workout lebih benar.
                </p>
            </div>

            <!-- CARD -->
            <div class="sg-modern-card bg-white rounded-3xl p-8 shadow-sm">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-orange-100 flex items-center justify-center text-4xl">
                    🏋️
                </div>

                <h3 class="font-bold text-xl mt-6">
                    Alat Lengkap
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Berbagai alat fitness modern untuk semua jenis latihan.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ================= PRICING ================= -->
<section id="pricing" class="py-28 bg-white px-6">

    <div class="max-w-7xl mx-auto text-center">

        <span class="text-blue-600 font-bold uppercase tracking-widest">
            Membership
        </span>

        <h2 class="text-5xl font-black mt-4">
            Paket Member
        </h2>

        <p class="mt-4 text-gray-600 mb-16">
            Pilih paket membership terbaik untuk progress latihanmu.
        </p>

        <div class="grid md:grid-cols-3 gap-10">

            <!-- 1 BULAN -->
            <div class="sg-modern-card border border-gray-200 rounded-[30px] p-10 bg-white">

                <h3 class="font-black text-2xl text-gray-700">
                    1 BULAN
                </h3>

                <p class="text-5xl font-black my-8 text-blue-600">
                    Rp125K
                </p>

                <ul class="space-y-4 text-gray-500">
                    <li>✔ Akses Full Fasilitas</li>
                    <li>✔ Bebas Jam Latihan</li>
                    <li>✔ Konsultasi Alat</li>
                </ul>

                <a href="{{ route('login') }}"
                   class="block mt-10 bg-gray-100 hover:bg-blue-600 hover:text-white py-4 rounded-2xl font-bold transition duration-300">
                    Pilih Paket
                </a>
            </div>

            <!-- BEST -->
            <div class="relative border-2 border-blue-600 rounded-[35px] p-10 bg-gradient-to-b from-blue-600 to-cyan-500 text-white shadow-2xl scale-105">

                <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-black text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg">
                    🔥 BEST VALUE
                </div>

                <h3 class="font-black text-2xl">
                    3 BULAN
                </h3>

                <p class="text-5xl font-black my-8">
                    Rp300K
                </p>

                <ul class="space-y-4 text-blue-100">
                    <li>✔ Akses Full Fasilitas</li>
                    <li>✔ Hemat Rp75.000</li>
                    <li>✔ Bebas Jam Latihan</li>
                </ul>

                <a href="{{ route('login') }}"
                   class="block mt-10 bg-white text-blue-600 py-4 rounded-2xl font-bold hover:scale-105 transition">
                    Pilih Paket
                </a>
            </div>

            <!-- 6 BULAN -->
            <div class="sg-modern-card border border-gray-200 rounded-[30px] p-10 bg-white">

                <h3 class="font-black text-2xl text-gray-700">
                    6 BULAN
                </h3>

                <p class="text-5xl font-black my-8 text-blue-600">
                    Rp500K
                </p>

                <ul class="space-y-4 text-gray-500">
                    <li>✔ Akses Full Fasilitas</li>
                    <li>✔ Hemat Rp250.000</li>
                    <li>✔ Paket Terhemat</li>
                </ul>

                <a href="{{ route('login') }}"
                   class="block mt-10 bg-gray-100 hover:bg-blue-600 hover:text-white py-4 rounded-2xl font-bold transition duration-300">
                    Pilih Paket
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact" class="py-28 bg-gray-50 px-6 border-t">

    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-16">

            <span class="text-blue-600 font-bold uppercase tracking-widest">
                Contact
            </span>

            <h2 class="text-5xl font-black mt-4">
                Hubungi Kami
            </h2>

            <p class="mt-4 text-gray-600">
                Datang langsung atau hubungi sosial media Shelter Gym.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-10">

            <!-- LOCATION -->
            <div class="bg-white rounded-[35px] p-8 shadow-lg">

                <div class="flex items-center gap-4 text-blue-600">
                    <i class="fa-solid fa-location-dot text-3xl"></i>

                    <div>
                        <h3 class="font-black text-2xl text-gray-800">
                            Lokasi Shelter Gym
                        </h3>

                        <p class="text-gray-500 text-sm mt-1">
                            Jatiasih, Bekasi
                        </p>
                    </div>
                </div>

                <p class="text-gray-600 mt-6 leading-relaxed">
                    Jl. Raya Kodau, RT.003/RW.002,
                    Jatimekar, Kec. Jatiasih,
                    Kota Bekasi, Jawa Barat 17422
                </p>

                <div class="w-full h-[350px] rounded-3xl overflow-hidden mt-8 shadow-inner">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7363403565554!2d106.924845!3d-6.298355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698b4b141dbc97%3A0x32dc39f3950b8e57!2sTHE%20SHELTER%20GYM!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        class="w-full h-full border-0"
                        loading="lazy">
                    </iframe>

                </div>
            </div>

            <!-- SOCIAL -->
            <div class="bg-white rounded-[35px] p-8 shadow-lg flex flex-col justify-between">

                <div>

                    <div class="flex items-center gap-4 text-blue-600">
                        <i class="fa-solid fa-comments text-3xl"></i>

                        <div>
                            <h3 class="font-black text-2xl text-gray-800">
                                Sosial Media
                            </h3>

                            <p class="text-gray-500 text-sm mt-1">
                                Tetap terhubung bersama kami
                            </p>
                        </div>
                    </div>

                    <div class="space-y-5 mt-10">

                        <!-- WA -->
                        <a href="https://wa.me/628118843030"
                           target="_blank"
                           class="flex items-center justify-between p-5 rounded-2xl bg-emerald-50 hover:bg-emerald-100 transition duration-300 hover:scale-[1.02]">

                            <div class="flex items-center gap-4">

                                <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-2xl">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>

                                <div>
                                    <p class="font-bold text-emerald-700">
                                        WhatsApp
                                    </p>

                                    <p class="text-sm text-emerald-600">
                                        0811-8843-030
                                    </p>
                                </div>
                            </div>

                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                        <!-- IG -->
                        <a href="https://www.instagram.com/sheltergymoffc/"
                           target="_blank"
                           class="flex items-center justify-between p-5 rounded-2xl bg-pink-50 hover:bg-pink-100 transition duration-300 hover:scale-[1.02]">

                            <div class="flex items-center gap-4">

                                <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-600 text-2xl">
                                    <i class="fa-brands fa-instagram"></i>
                                </div>

                                <div>
                                    <p class="font-bold text-pink-700">
                                        Instagram
                                    </p>

                                    <p class="text-sm text-pink-600">
                                        @sheltergymoffc
                                    </p>
                                </div>
                            </div>

                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                        <!-- TIKTOK -->
                        <a href="https://www.tiktok.com/@shelter.gym"
                           target="_blank"
                           class="flex items-center justify-between p-5 rounded-2xl bg-gray-900 hover:bg-black transition duration-300 hover:scale-[1.02] text-white">

                            <div class="flex items-center gap-4">

                                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">
                                    <i class="fa-brands fa-tiktok"></i>
                                </div>

                                <div>
                                    <p class="font-bold">
                                        TikTok
                                    </p>

                                    <p class="text-sm text-gray-300">
                                        @shelter.gym
                                    </p>
                                </div>
                            </div>

                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>
                </div>

                <!-- JAM -->
                <div class="mt-10 bg-blue-50 rounded-2xl p-5">

                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-clock text-blue-600 text-xl"></i>

                        <div>
                            <p class="font-bold text-blue-700">
                                Jam Operasional
                            </p>

                            <p class="text-sm text-blue-600">
                                Senin - Minggu • 24 Jam
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="relative overflow-hidden bg-gray-950 text-white pt-20">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-blue-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-cyan-500/20 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <!-- GRID -->
        <div class="grid md:grid-cols-4 gap-14 pb-16 border-b border-white/10 text-center md:text-left">

            <!-- BRAND -->
            <div class="flex flex-col items-center md:items-start">

                <img src="/images/logo/logo_dark.png"
                     class="h-14">

                <p class="text-gray-400 mt-6 leading-relaxed max-w-xs">
                    Tempat fitness modern dengan fasilitas lengkap,
                    trainer profesional, dan komunitas yang suportif.
                </p>

                <!-- SOCIAL -->
                <div class="flex gap-4 mt-8 justify-center md:justify-start">

                    {{-- <a href="#"
                       class="sg-social-icon w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center hover:bg-blue-600">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a> --}}

                    <a href="https://www.instagram.com/sheltergymoffc/"
                       class="sg-social-icon w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center hover:bg-pink-600">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://www.tiktok.com/@shelter.gym"
                       class="sg-social-icon w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center hover:bg-black">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>

                    <a href="https://wa.me/628118843030"
                       class="sg-social-icon w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center hover:bg-emerald-600">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>

                </div>
            </div>

            <!-- MENU -->
            <div>

                <h3 class="text-xl font-bold mb-6">
                    Navigasi
                </h3>

                <div class="flex flex-col gap-4 text-gray-400">

                    <a href="#home" class="sg-footer-link">
                        Home
                    </a>

                    <a href="#about" class="sg-footer-link">
                        About
                    </a>

                    <a href="#facilities" class="sg-footer-link">
                        Facilities
                    </a>

                    <a href="#pricing" class="sg-footer-link">
                        Pricing
                    </a>

                    <a href="#contact" class="sg-footer-link">
                        Contact
                    </a>

                </div>
            </div>

            <!-- SERVICES -->
            <div>

                <h3 class="text-xl font-bold mb-6">
                    Layanan
                </h3>

                <div class="flex flex-col gap-4 text-gray-400">

                    <p class="sg-footer-link">Arena Panco</p>
                    <p class="sg-footer-link">Fitness Exerciess</p>
                    <p class="sg-footer-link">Weight Machine</p>
                    <p class="sg-footer-link">Cardio Machine</p>
                    <p class="sg-footer-link">Free Weight</p>

                </div>
            </div>

            <!-- NEWSLETTER -->
            <div class="flex flex-col items-center md:items-start">

                <h3 class="text-xl font-bold mb-6">
                    Newsletter
                </h3>

                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    Dapatkan info promo terbaru dan tips workout langsung dari Shelter Gym.
                </p>

                <div class="mt-6 flex flex-col gap-4 w-full max-w-sm">

                    <input type="email"
                           placeholder="Masukkan Email..."
                           class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none focus:border-blue-500 text-white">

                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-cyan-500 py-4 rounded-2xl font-bold hover:scale-[1.02] transition">
                        Subscribe Sekarang
                    </a>

                </div>
            </div>

        </div>

        <!-- COPYRIGHT -->
        <div class="py-8 flex flex-col md:flex-row items-center justify-center md:justify-between gap-4 text-center">

            <p class="text-gray-500 text-sm">
                © 2026 Shelter Gym. All Rights Reserved.
            </p>

            <p class="text-gray-500 text-sm">
                Made with ❤️ by Wotech Developer
            </p>

        </div>

    </div>
</footer>

<!-- ================= JAVASCRIPT ================= -->
<script>

    // MOBILE MENU
    const sgMobileBtn = document.getElementById('sgMobileBtn');
    const sgMobileMenu = document.getElementById('sgMobileMenu');

    sgMobileBtn.addEventListener('click', () => {
        sgMobileMenu.classList.toggle('active');
    });

    // NAVBAR SHADOW ON SCROLL
    window.addEventListener('scroll', function(){

        const navbar = document.querySelector('nav');

        if(window.scrollY > 20){
            navbar.classList.add('shadow-xl');
        }else{
            navbar.classList.remove('shadow-xl');
        }
    });

</script>

</body>
</html>