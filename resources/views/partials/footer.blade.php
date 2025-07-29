<footer>
    <div class="footer-container">
        <div class="footer-section footer-brand">
            <h2>Pemba Hardware Store</h2>
            <p>Quality tools and building materials at affordable prices.</p>
            <address>
                Kombo Munyiri Road, Nairobi<br>
                Phone: <a href="tel:+254799029295">0799029295</a><br>
                WhatsApp: <a href="https://wa.me/254740884932" target="_blank" rel="noopener">0740884932</a>
            </address>
        </div>

        <nav class="footer-section footer-links" aria-label="Footer Navigation">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/products') }}">Products</a></li>
                <li><a href="{{ url('/categories') }}">Categories</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
                <li><a href="{{ url('/about') }}">About</a></li>
            </ul>
        </nav>

        <div class="footer-section footer-hours">
            <h3>Business Hours</h3>
            <p>Mon - Fri: 8am - 6pm</p>
            <p>Sat: 9am - 4pm</p>
            <p>Sun: Closed</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 Pemba Hardware Store. All rights reserved.</p>
    </div>
</footer>

@push('styles')
<style>
    footer {
        background-color: #f8f9fa;
        color: #0b3d91;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 2rem 1rem 1rem;
        border-top: 1px solid #ddd;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .footer-section {
        flex: 1 1 250px;
        min-width: 220px;
    }

    .footer-brand h2 {
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
    }

    .footer-brand p,
    .footer-brand address {
        font-size: 1rem;
        line-height: 1.5;
    }

    .footer-brand address a {
        color: #0b3d91;
        text-decoration: none;
    }

    .footer-brand address a:hover,
    .footer-links ul li a:hover {
        text-decoration: underline;
    }

    .footer-links h3,
    .footer-hours h3 {
        margin-bottom: 0.75rem;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links ul li {
        margin-bottom: 0.5rem;
    }

    .footer-links ul li a {
        color: #0b3d91;
        text-decoration: none;
        font-weight: 500;
    }

    .footer-hours p {
        margin: 0.3rem 0;
        font-size: 1rem;
    }

    .footer-bottom {
        text-align: center;
        padding: 1rem 0 0 0;
        font-size: 0.9rem;
        color: #555;
        border-top: 1px solid #ddd;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            gap: 1.5rem;
        }

        .footer-section {
            min-width: 100%;
        }
    }
</style>
@endpush
