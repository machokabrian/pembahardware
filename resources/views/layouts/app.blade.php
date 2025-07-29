<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Pemba Hardware')</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
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
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Header */
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
        }
        .logo img {
            height: 50px;
            width: 50px;
            object-fit: contain;
            border-radius: 5px;
        }
        header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Navigation */
        nav {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        nav a {
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }
        nav a:focus-visible {
            outline: 2px solid #a7ffeb;
            outline-offset: 2px;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: center;
            width: 30px;
            height: 30px;
            cursor: pointer;
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
            display: none;
            flex-direction: column;
            background: #003d33;
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 5px;
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
            .mobile-nav.show {
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

        /* Main content */
        main {
            padding: 2rem 0;
            min-height: 70vh;
        }

        /* Footer */
        footer {
            background-color: #004d40;
            color: #e0f2f1;
            padding: 2rem 1rem;
            font-size: 0.9rem;
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
        footer .contact-info {
            flex: 1 1 280px;
        }
        footer .map-container {
            flex: 1 1 320px;
            min-width: 280px;
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

        /* Pulse animation */
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

        /* Hover effects */
        #whatsapp-float:hover {
            background-color: #128c7e;
            transform: scale(1.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 15px;
                right: 15px;
            }
            #whatsapp-float svg {
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
                <img src="{{ asset('images/logo.png') }}" alt="Pemba Hardware Logo" />
                <h1>Pemba Hardware</h1>
            </a>

            <!-- Mobile Hamburger -->
            <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileMenu">
                <span></span>
                <span></span>
                <span></span>
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

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <section class="contact-info" id="contact" aria-label="Contact Information">
                <h2 style="margin-top:0; color:#a7ffeb;">Contact Us</h2>
                <address>
                    Kombo Munyiri Road, Nairobi<br />
                    Phone: <a href="tel:0799029295">0799 029 295</a><br />
                    WhatsApp: <a href="https://wa.me/254740884932" target="_blank" rel="noopener noreferrer">0740 884 932</a>
                </address>
            </section>
            <section class="map-container" aria-label="Pemba Hardware Location on Google Maps">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.343251326941!2d36.8454!3d-1.2358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10b2cc488e4d%3A0x6452463c6fae1f14!2sKombo%20Munyiri%20Rd%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1690680845983!5m2!1sen!2ske" 
                    title="Pemba Hardware Location Map"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </section>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/254740884932" 
       target="_blank" 
       rel="noopener noreferrer" 
       id="whatsapp-float" 
       aria-label="Chat with Pemba Hardware on WhatsApp"
       style="position: fixed;
              bottom: 20px;
              right: 20px;
              z-index: 1000;
              width: 60px;
              height: 60px;
              background-color: #25d366;
              border-radius: 50%;
              box-shadow: 0 4px 8px rgba(0,0,0,0.3);
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              transition: all 0.3s ease;
              animation: pulse 2s infinite;">
        <svg xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 448 512" 
             width="32" 
             height="32" 
             fill="white" role="img" aria-hidden="true" focusable="false">
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L4 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
        </svg>
    </a>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const mobileMenu = document.getElementById('mobileMenu');

        function toggleMenu() {
            const isShown = mobileMenu.classList.toggle('show');
            mobileMenu.hidden = !isShown;
            menuToggle.setAttribute('aria-expanded', isShown);
        }

        // Optional: close mobile menu when clicking outside or on a link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('show');
                mobileMenu.hidden = true;
                menuToggle.setAttribute('aria-expanded', false);
            });
        });
    </script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @stack('scripts')
</body>
</html>
