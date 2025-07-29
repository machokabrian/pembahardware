<nav class="navbar" role="navigation" aria-label="Primary Navigation">
    <div class="container">
        {{-- Branding / Logo --}}
        <a href="{{ url('/') }}" class="navbar-brand" aria-label="Pemba Hardware Store Home">
            {{-- You can replace this text with an <img> tag for a logo --}}
            <strong>Pemba Hardware</strong>
        </a>

        {{-- Hamburger toggle for mobile --}}
        <button class="navbar-toggler" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation" type="button" id="navbar-toggle">
            &#9776;
        </button>

        {{-- Navigation links --}}
        <div class="navbar-menu" id="navbar-menu" aria-hidden="true">
            <ul class="navbar-links">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/products') }}" class="{{ request()->is('products*') ? 'active' : '' }}">Products</a></li>
                <li><a href="{{ url('/categories') }}" class="{{ request()->is('categories*') ? 'active' : '' }}">Categories</a></li>
                <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
            </ul>

            {{-- Contact shortcut --}}
            <div class="navbar-contact">
                <a href="tel:+254799029295" aria-label="Call Pemba Hardware Store">📞 0799029295</a> |
                <a href="https://wa.me/254740884932" target="_blank" rel="noopener" aria-label="WhatsApp Pemba Hardware Store">💬 WhatsApp</a>
            </div>
        </div>
    </div>

    {{-- Inline styles and JS for simplicity; ideally put in external CSS/JS --}}
    <style>
        /* Basic Reset & Container */
        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        /* Branding */
        .navbar-brand {
            color: #0b3d91;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        /* Hamburger */
        .navbar-toggler {
            font-size: 1.8rem;
            background: none;
            border: none;
            color: #0b3d91;
            cursor: pointer;
            display: none; /* hide on desktop */
        }

        /* Navigation links */
        .navbar-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
            padding: 0;
            margin: 0;
        }
        .navbar-links li a {
            color: #0b3d91;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }
        .navbar-links li a:hover,
        .navbar-links li a:focus {
            color: #fca311;
            outline: none;
        }
        .navbar-links li a.active {
            color: #fca311;
            border-bottom: 2px solid #fca311;
        }

        /* Contact shortcut */
        .navbar-contact {
            margin-left: 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #0b3d91;
            white-space: nowrap;
        }
        .navbar-contact a {
            color: #0b3d91;
            text-decoration: none;
            margin: 0 0.3rem;
        }
        .navbar-contact a:hover,
        .navbar-contact a:focus {
            color: #fca311;
            outline: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-toggler {
                display: block;
            }

            .navbar-menu {
                width: 100%;
                display: none;
                flex-direction: column;
                margin-top: 1rem;
            }

            .navbar-menu.show {
                display: flex;
            }

            .navbar-links {
                flex-direction: column;
                gap: 1rem;
                margin-bottom: 1rem;
            }

            .navbar-contact {
                margin-left: 0;
                font-size: 1rem;
            }
        }
    </style>

    <script>
        // Toggle menu on hamburger click
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('navbar-toggle');
            const menu = document.getElementById('navbar-menu');

            toggleButton.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                if (menu.classList.contains('show')) {
                    menu.classList.remove('show');
                    menu.setAttribute('aria-hidden', 'true');
                } else {
                    menu.classList.add('show');
                    menu.setAttribute('aria-hidden', 'false');
                }
            });
        });
    </script>
</nav>
