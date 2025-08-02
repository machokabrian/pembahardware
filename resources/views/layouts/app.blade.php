<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Pemba Hardware')</title>
  <meta name="description" content="Pemba Hardware offers quality tools, plumbing supplies, and fasteners to make your projects easier and more productive." />

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

  <!-- AOS Animation CSS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <!-- Font Awesome (for WhatsApp icon) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Optional: Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
        Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background: #f9f9f9;
      color: #333;
      line-height: 1.6;
    }

    a {
      color: #26a69a;
      text-decoration: none;
    }

    a:hover,
    a:focus {
      text-decoration: underline;
      outline: none;
    }

    a:focus-visible,
    button:focus-visible {
      outline: 2px solid #a7ffeb;
      outline-offset: 3px;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 1rem;
    }

    header {
      background-color: #004d40;
      color: white;
      padding: 1rem 0;
    }

    header .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      text-decoration: none;
      color: white;
    }

    .logo-icon {
      width: 36px;
      height: 36px;
      fill: #FFD54F; /* colored hammer */
      animation: bounceRotate 2s infinite;
      transition: transform 0.3s ease, fill 0.3s ease;
      flex-shrink: 0;
    }

    .logo-icon:hover {
      fill: #FFB300; /* darker golden on hover */
      transform: scale(1.1);
    }

    @keyframes bounceRotate {
      0% {
        transform: rotate(0deg) translateY(0);
      }
      30% {
        transform: rotate(-10deg) translateY(-4px);
      }
      50% {
        transform: rotate(5deg) translateY(0);
      }
      70% {
        transform: rotate(-3deg) translateY(-2px);
      }
      100% {
        transform: rotate(0deg) translateY(0);
      }
    }

    header h1 {
      margin: 0;
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: 1px;
      user-select: none;
    }

    nav.desktop-nav {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    nav.desktop-nav a {
      color: white;
      font-weight: 600;
      font-size: 1rem;
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    nav.desktop-nav a:hover {
      background-color: rgba(167, 255, 235, 0.2);
    }

    nav.desktop-nav a:focus-visible {
      outline: 2px solid #a7ffeb;
      outline-offset: 2px;
    }

    .menu-toggle {
      display: none;
      flex-direction: column;
      justify-content: center;
      width: 30px;
      height: 30px;
      cursor: pointer;
      background: transparent;
      border: none;
    }

    .menu-toggle span {
      background: white;
      height: 3px;
      margin: 4px 0;
      width: 100%;
      border-radius: 2px;
      transition: background-color 0.3s ease;
    }

    .menu-toggle:hover span,
    .menu-toggle:focus {
      background-color: #a7ffeb;
      outline: none;
    }

    .mobile-nav {
      max-height: 0;
      overflow: hidden;
      background: #003d33;
      padding: 0 1rem;
      margin-top: 0;
      border-radius: 0 0 5px 5px;
      transition: max-height 0.4s ease, padding 0.4s ease;
    }

    .mobile-nav.show {
      max-height: 500px;
      padding: 1rem;
      margin-top: 1rem;
      border-radius: 5px;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .mobile-nav a {
      padding: 0.5rem 0;
      color: #e0f2f1;
      font-weight: 600;
      font-size: 1.1rem;
    }

    .mobile-nav a:focus-visible {
      outline: 2px solid #a7ffeb;
      outline-offset: 2px;
    }

    @media (max-width: 768px) {
      nav.desktop-nav {
        display: none;
      }

      .menu-toggle {
        display: flex;
      }
    }

    .hero-title {
      color: #004d40;
      font-weight: 700;
      font-size: 2.25rem;
      text-align: center;
      margin-bottom: 1rem;
    }

    main.container {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      min-height: 70vh;
    }

    footer {
      background-color: #004d40;
      color: #e0f2f1;
      padding: 2rem 1rem;
      font-size: 1rem;
      line-height: 1.5;
    }

    footer a {
      color: #a7ffeb;
    }

    footer a:hover,
    footer a:focus {
      color: #ffffff;
      text-decoration: underline;
      outline: none;
    }

    footer .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 1rem;
      max-width: 1100px;
      margin: 0 auto;
      align-items: center;
    }

    footer .contact-info,
    footer .map-container {
      margin-bottom: 1rem;
      flex: 1 1 320px;
      min-width: 280px;
    }

    footer .map-container {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
    }

    footer iframe {
      border: 0;
      width: 100%;
      height: 200px;
      display: block;
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
      }
      70% {
        box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
      }
    }

    #whatsapp-float:hover {
      background-color: #128c7e;
      transform: scale(1.1);
    }

    @media (max-width: 768px) {
      #whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 15px;
        right: 15px;
      }

      #whatsapp-float svg,
      #whatsapp-float i {
        width: 28px;
        height: 28px;
      }
    }
  </style>
  @stack('styles')
</head>
<body>
  <header>
    <div class="container">
      <a href="{{ url('/') }}" class="logo" aria-label="Pemba Hardware Home">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="logo-icon" aria-hidden="true" focusable="false">
          <path d="M512 320h-96v-64h96v64zM607 201c-9 9-23 11-34 5L443 112c-9-6-12-18-6-27l32-48c7-10 20-12 30-6l123 81c10 6 12 20 6 30l-21 31zm-55 167l-96-96v96h96zM214 52c-7-11-23-14-34-6L107 105c-12 8-14 25-5 36l48 64c9 12 26 14 38 5l72-56c10-8 13-21 7-33L214 52zm-66 171l-44-59 57-40 44 59-57 40zM316 448h-40v-84l-40-56v-60l-24 19v81c0 5 2 10 5 14l40 56v96h80v-96l40-56c3-4 5-9 5-14v-81l-24-19v60l-40 56v84z"/>
        </svg>
        <h1>Pemba Hardware</h1>
      </a>

      <!-- Mobile Hamburger -->
      <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileMenu" id="menuToggleBtn">
        <span></span><span></span><span></span>
      </button>

      <!-- Desktop Navigation -->
      <nav class="desktop-nav" aria-label="Primary navigation">
        <a href="{{ url('/') }}">Home</a>
        <a href="#categories">Categories</a>
        <a href="#contact">Contact</a>
      </nav>
    </div>

    <!-- Mobile Navigation -->
    <nav id="mobileMenu" class="mobile-nav" aria-label="Mobile navigation" hidden>
      <a href="{{ url('/') }}">Home</a>
      <a href="#categories">Categories</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>

  <main class="container" role="main">
    @yield('content')
  </main>

  <footer>
    <div class="footer-container">
      <section class="contact-info" id="contact" aria-label="Contact Information">
        <h2 style="margin-top:0; color:#a7ffeb;">Contact Us</h2>
        <address>
          Kombo Munyiri Road, Nairobi<br />
          Phone: <a href="tel:0799029295">0799 029 295</a><br />
          WhatsApp: <a href="https://wa.me/254740884932" target="_blank">0740 884 932</a>
        </address>
      </section>
      <section class="map-container" aria-label="Pemba Hardware Location on Google Maps">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.420214393247!2d36.8169494152606!3d-1.292065699084847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10b2ed9dbf45%3A0x9491f9bd4f9e3b6a!2sKombo%20Munyiri%20Road%2C%20Nairobi%2C%20Kenya!5e0!3m2!1sen!2sus!4v1690888888888!5m2!1sen!2sus" 
    allowfullscreen 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</section>

    </div>
  </footer>

  <!-- WhatsApp Button -->
  <a href="https://wa.me/254740884932" target="_blank" id="whatsapp-float" aria-label="Chat on WhatsApp"
     style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; width: 60px; height: 60px; background-color: #25d366;
            border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.3s ease; animation: pulse 2s infinite;">
    <i class="fab fa-whatsapp" style="font-size: 32px; color: white;"></i>
  </a>

  <script>
    const menuToggle = document.getElementById('menuToggleBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    function toggleMenu() {
      const isShown = mobileMenu.classList.toggle('show');
      if (isShown) {
        mobileMenu.hidden = false;
      } else {
        setTimeout(() => {
          if (!mobileMenu.classList.contains('show')) mobileMenu.hidden = true;
        }, 400);
      }
      menuToggle.setAttribute('aria-expanded', isShown);
    }

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('show');
        setTimeout(() => (mobileMenu.hidden = true), 400);
        menuToggle.setAttribute('aria-expanded', false);
      });
    });
  </script>

  <!-- AOS -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
  </script>

  @stack('scripts')
</body>
</html>
