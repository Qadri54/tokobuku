<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TokoBuku.ID - Daftar Buku</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 0;
            background-color: #f4f7ff;
            color: #333;
            transition: background 0.4s, color 0.4s;
        }
        header {
            background-color: #3f51b5;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }
        header h1 { margin: 0; font-size: 24px; }
        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        nav a:hover { color: #ffca28; }
        .search-container {
            flex: 1;
            margin: 10px 20px;
        }
        .search-container input {
            width: 100%;
            padding: 8px 15px;
            border-radius: 20px;
            border: none;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        #darkModeToggle {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-left: 20px;
        }
        .hero {
            background: linear-gradient(135deg, #7986cb, #3f51b5);
            color: white;
            padding: 50px 20px;
            text-align: center;
        }
        .swiper {
            width: 100%;
            padding: 30px 0;
        }
        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .swiper-slide img {
            width: 90%;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
            gap: 25px;
        }
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(63,81,181,0.2);
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            animation: fadeInUp 0.6s forwards;
        }
        .card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 12px 20px rgba(63,81,181,0.4);
        }
        .card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .card h3 { font-size: 20px; color: #3f51b5; margin: 10px 0 6px; }
        .card p { margin: 4px 0; font-weight: 500; color: #555; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dark-mode {
            background-color: #1e1e2f;
            color: #eee;
        }
        .dark-mode header { background-color: #282c3f; }
        .dark-mode .card { background-color: #2f3447; color: #eee; }
        .dark-mode nav a { color: #ddd; }
        .dark-mode nav a:hover { color: #ffca28; }

        #contact-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3f51b5;
            color: white;
            padding: 12px 16px;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(63,81,181,0.5);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: width 0.3s ease, padding 0.3s ease;
            width: 48px;
            overflow: hidden;
            white-space: nowrap;
            z-index: 1000;
        }
        #contact-widget:hover {
            width: 140px;
            padding: 12px 20px;
            box-shadow: 0 6px 20px rgba(63,81,181,0.7);
        }
        #contact-widget .icon-cs { font-size: 20px; }
        #contact-widget .contact-text {
            opacity: 0;
            transition: opacity 0.3s ease;
            user-select: none;
        }
        #contact-widget:hover .contact-text {
            opacity: 1;
        }
    </style>
</head>
<body>

<header>
    <h1>TokoBuku.ID</h1>
    <nav>
        <a href="#">Beranda</a>
        <a href="#">Kategori</a>
        <a href="#">Kontak</a>
    </nav>
    <button id="darkModeToggle" title="Toggle dark mode">🌓</button>
    <div class="search-container">
        <input type="text" id="searchBox" placeholder="Cari buku...">
    </div>
</header>

<section class="hero">
    <h2>Temukan Buku Favoritmu!</h2>
    <p>Jelajahi koleksi buku lengkap dari berbagai genre. Buku berkualitas, harga bersahabat.</p>
</section>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="banner/banner1.jpg" alt="Banner 1"></div>
        <div class="swiper-slide"><img src="banner/banner2.jpg" alt="Banner 2"></div>
        <div class="swiper-slide"><img src="banner/banner3.jpg" alt="Banner 3"></div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 3000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });

    document.getElementById('darkModeToggle').onclick = () =>
        document.body.classList.toggle('dark-mode');

    document.getElementById('searchBox').addEventListener('keyup', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('.card').forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const penulis = card.querySelectorAll('p')[0].textContent.toLowerCase();
            card.style.display = title.includes(term) || penulis.includes(term) ? 'block' : 'none';
        });
    });
</script>
