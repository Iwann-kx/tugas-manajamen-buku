<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Buku</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #17231e;
            background: #f7f8f4;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; }
        a { color: inherit; text-decoration: none; }
        .page { min-height: 100vh; overflow: hidden; }
        .topbar {
            width: min(1120px, calc(100% - 48px));
            height: 88px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand { display: flex; align-items: center; gap: 12px; font-size: 17px; font-weight: 750; letter-spacing: -.4px; }
        .brand-mark {
            width: 40px; height: 40px; border-radius: 13px; display: grid; place-items: center;
            color: #f7f8f4; background: #193c30; box-shadow: 0 5px 12px #193c3024;
        }
        .brand-mark svg { width: 22px; height: 22px; }
        .nav { display: flex; align-items: center; gap: 12px; }
        .nav a { padding: 11px 17px; border-radius: 10px; font-size: 14px; font-weight: 650; }
        .nav-login { color: #294239; }
        .nav-register, .button-primary { background: #193c30; color: white; }
        .nav-register:hover, .button-primary:hover { background: #245541; }
        .hero {
            width: min(1120px, calc(100% - 48px));
            margin: 48px auto 0;
            min-height: 510px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 32px;
        }
        .eyebrow {
            display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 999px;
            background: #e8eee8; color: #315846; font-size: 12px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase;
        }
        .eyebrow-dot { width: 7px; height: 7px; border-radius: 50%; background: #5a916d; }
        h1 { max-width: 590px; margin: 22px 0 18px; font-size: clamp(42px, 5.3vw, 68px); line-height: 1.04; letter-spacing: -.065em; }
        h1 span { color: #528167; }
        .lead { max-width: 510px; margin: 0; color: #69756e; font-size: 17px; line-height: 1.8; }
        .actions { display: flex; flex-wrap: wrap; align-items: center; gap: 13px; margin-top: 30px; }
        .button { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 14px 20px; border-radius: 11px; font-size: 14px; font-weight: 700; transition: background .2s, transform .2s; }
        .button:hover { transform: translateY(-1px); }
        .button-primary { box-shadow: 0 8px 18px #193c3025; }
        .button-secondary { border: 1px solid #dce3db; background: #fff; color: #294239; }
        .button-secondary:hover { background: #f0f3ef; }
        .arrow { font-size: 18px; line-height: 12px; }
        .note { margin-top: 22px; color: #89938c; font-size: 12px; }
        .art {
            min-height: 440px; position: relative; display: grid; place-items: center;
            border: 1px solid #e8ebe4; border-radius: 28px;
            background: radial-gradient(ellipse at 50% 46%, #e5eee4 0, #edf2eb 37%, #f7f8f4 74%);
        }
        .art-orbit { position: absolute; width: 310px; height: 310px; border: 1px solid #d4dfd4; border-radius: 50%; }
        .art-orbit::before, .art-orbit::after { content: ""; position: absolute; inset: 25px; border: 1px solid #dce5dc; border-radius: 50%; }
        .art-orbit::after { inset: -28px; border-color: #e7ece5; }
        .book-stack { position: relative; width: 245px; height: 255px; transform: rotate(-7deg); }
        .book {
            position: absolute; left: 22px; width: 205px; height: 72px; border-radius: 7px 12px 12px 7px;
            box-shadow: 0 14px 24px #17231e20; border-left: 9px solid #ffffff3d;
        }
        .book::after { content: ""; position: absolute; left: 16px; right: 14px; top: 17px; height: 1px; background: #ffffff70; box-shadow: 0 6px #ffffff42; }
        .book-one { top: 24px; background: #b66f4c; transform: rotate(7deg); }
        .book-two { top: 102px; left: 0; background: #315846; transform: rotate(-3deg); }
        .book-three { top: 180px; left: 28px; background: #d3a75d; transform: rotate(4deg); }
        .plant { position: absolute; right: 36px; bottom: 42px; width: 58px; height: 94px; border-bottom: 5px solid #c9ab7d; border-radius: 50%; }
        .plant::before, .plant::after { content: ""; position: absolute; width: 29px; height: 49px; background: #7e9d76; border-radius: 100% 0 100% 0; }
        .plant::before { left: 5px; top: 4px; transform: rotate(-24deg); }
        .plant::after { right: 0; top: 20px; transform: rotate(32deg) scaleX(-1); }
        .spark { position: absolute; color: #bd9856; font-size: 25px; }
        .spark-one { top: 72px; right: 75px; }
        .spark-two { bottom: 92px; left: 56px; font-size: 17px; }
        .features {
            width: min(1120px, calc(100% - 48px)); margin: 28px auto 0; padding: 25px 0 34px;
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; border-top: 1px solid #e6e9e3;
        }
        .feature { display: flex; gap: 13px; align-items: flex-start; }
        .feature-icon { flex: 0 0 38px; height: 38px; display: grid; place-items: center; border-radius: 12px; background: #e8eee8; color: #315846; font-size: 16px; font-weight: 800; }
        .feature strong { display: block; margin: 2px 0 5px; font-size: 14px; }
        .feature p { margin: 0; color: #7a857e; font-size: 12px; line-height: 1.6; }
        footer { padding: 18px 24px 24px; color: #9aa39c; text-align: center; font-size: 11px; }
        @media (max-width: 760px) {
            .topbar { height: 72px; }
            .hero { margin-top: 28px; grid-template-columns: 1fr; gap: 34px; }
            .hero-copy { padding-top: 12px; }
            .art { min-height: 340px; }
            .art-orbit { transform: scale(.78); }
            .book-stack { transform: rotate(-7deg) scale(.82); }
            .features { grid-template-columns: 1fr; gap: 20px; margin-top: 36px; }
        }
        @media (max-width: 420px) {
            .topbar, .hero, .features { width: min(100% - 32px, 1120px); }
            .brand { font-size: 14px; gap: 8px; }
            .brand-mark { width: 36px; height: 36px; }
            .nav { gap: 2px; }
            .nav a { padding: 10px; font-size: 12px; }
            h1 { font-size: 43px; }
            .lead { font-size: 15px; }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a class="brand" href="{{ url('/') }}" aria-label="Manajemen Buku - Beranda">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M5 5.5A2.5 2.5 0 0 1 7.5 3H20v16H7.5A2.5 2.5 0 0 0 5 21V5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M5 6v15m4-13h7m-7 4h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </span>
                <span>Manajemen Buku</span>
            </a>
            <nav class="nav" aria-label="Navigasi utama">
                @auth
                    <a class="nav-login" href="{{ route('dashboard') }}">Dashboard</a>
                    @can('view-books')
                        <a class="nav-register" href="{{ route('books.index') }}">Buka Katalog</a>
                    @endcan
                @else
                    <a class="nav-login" href="{{ route('login') }}">Masuk</a>
                    <a class="nav-register" href="{{ route('register') }}">Daftar</a>
                @endauth
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-copy">
                    <span class="eyebrow"><span class="eyebrow-dot"></span> Ruang literasi digital</span>
                    <h1>Kelola buku,<br><span>temukan inspirasi.</span></h1>
                    <p class="lead">
                        Satu tempat untuk mengelola koleksi buku kampus. Temukan informasi buku dengan mudah dan nikmati akses sesuai peran Anda.
                    </p>
                    <div class="actions">
                        @auth
                            @can('view-books')
                                <a class="button button-primary" href="{{ route('books.index') }}">Lihat Katalog <span class="arrow" aria-hidden="true">→</span></a>
                            @endcan
                            <a class="button button-secondary" href="{{ route('dashboard') }}">Buka Dashboard</a>
                        @else
                            <a class="button button-primary" href="{{ route('login') }}">Masuk ke Aplikasi <span class="arrow" aria-hidden="true">→</span></a>
                            <a class="button button-secondary" href="{{ route('register') }}">Buat Akun</a>
                        @endauth
                    </div>
                    <p class="note">Akses buku dan fitur dikelola berdasarkan role Admin, Dosen, dan Mahasiswa.</p>
                </div>

                <div class="art" role="img" aria-label="Ilustrasi tumpukan buku">
                    <div class="art-orbit"></div>
                    <span class="spark spark-one" aria-hidden="true">✳</span>
                    <span class="spark spark-two" aria-hidden="true">✦</span>
                    <div class="book-stack" aria-hidden="true">
                        <div class="book book-one"></div>
                        <div class="book book-two"></div>
                        <div class="book book-three"></div>
                    </div>
                    <div class="plant" aria-hidden="true"></div>
                </div>
            </section>

            <section class="features" aria-label="Fitur aplikasi">
                <article class="feature">
                    <span class="feature-icon" aria-hidden="true">01</span>
                    <div><strong>Katalog terorganisir</strong><p>Informasi judul, penulis, penerbit, dan tahun terbit tersusun rapi.</p></div>
                </article>
                <article class="feature">
                    <span class="feature-icon" aria-hidden="true">02</span>
                    <div><strong>Kelola dengan mudah</strong><p>Tambah dan perbarui koleksi buku sesuai hak akses akun.</p></div>
                </article>
                <article class="feature">
                    <span class="feature-icon" aria-hidden="true">03</span>
                    <div><strong>Akses terkontrol</strong><p>Setiap peran memiliki izin yang diperiksa langsung oleh server.</p></div>
                </article>
            </section>
        </main>
        <footer>Manajemen Buku · Laravel Breeze &amp; Spatie Permission</footer>
    </div>
</body>
</html>
