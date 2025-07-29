@extends('layouts.app')

@section('title', 'Pemba Hardware - Nairobi\'s Trusted Source for Tools & Hardware')

@section('content')
<div>

    {{-- Hero Section --}}
    <section class="text-center mb-5" aria-label="Welcome Message" data-aos="fade-down">
        <h2 style="color:#004d40; font-weight:700; font-size:2.25rem; text-align:center;">
            Welcome to Pemba Hardware
        </h2>
        <p style="font-size:1.125rem; max-width:600px; margin:0.5rem auto 0; color:#555;">
            Your trusted source for quality farm tools, plumbing supplies, and fasteners & hardware in Nairobi.
            We bring you durable products to empower your work and home.
        </p>
    </section>

    {{-- Categories Section --}}
    <section id="categories" aria-label="Main Product Categories" style="margin-bottom:3rem;">
        <h3 style="text-align:center; color:#00796b; font-weight:700; margin-bottom:1.5rem;" data-aos="fade-up">Our Main Categories</h3>
        <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:2rem;">
            {{-- Farm Tools --}}
            <article 
                tabindex="0" role="group" aria-label="Farm Tools category"
                style="background:#e0f2f1; border-radius:12px; box-shadow:0 3px 10px rgba(0,0,0,0.1); width:250px; padding:1.5rem; text-align:center; cursor:pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"
                data-aos="fade-right"
                data-aos-delay="100"
            >
                <img src="{{ asset('images/farm-tools-icon.png') }}" alt="Farm Tools Icon" width="80" height="80" loading="lazy" style="margin-bottom:1rem;">
                <h4 style="color:#004d40; margin-bottom:0.75rem;">Farm Tools</h4>
                <p style="color:#00695c; font-size:0.95rem;">
                    Explore durable hoes, pangas, sprayers, and other essential tools to make your farming easier and productive.
                </p>
            </article>

            {{-- Plumbing Supplies --}}
            <article 
                tabindex="0" role="group" aria-label="Plumbing Supplies category"
                style="background:#e0f2f1; border-radius:12px; box-shadow:0 3px 10px rgba(0,0,0,0.1); width:250px; padding:1.5rem; text-align:center; cursor:pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"
                data-aos="fade-right"
                data-aos-delay="200"
            >
                <img src="{{ asset('images/plumbing-icon.png') }}" alt="Plumbing Supplies Icon" width="80" height="80" loading="lazy" style="margin-bottom:1rem;">
                <h4 style="color:#004d40; margin-bottom:0.75rem;">Plumbing Supplies</h4>
                <p style="color:#00695c; font-size:0.95rem;">
                    Pipes, taps, connectors and fittings to meet your residential and commercial plumbing needs.
                </p>
            </article>

            {{-- Fasteners & Hardware --}}
            <article 
                tabindex="0" role="group" aria-label="Fasteners and Hardware category"
                style="background:#e0f2f1; border-radius:12px; box-shadow:0 3px 10px rgba(0,0,0,0.1); width:250px; padding:1.5rem; text-align:center; cursor:pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"
                data-aos="fade-right"
                data-aos-delay="300"
            >
                <img src="{{ asset('images/fasteners-icon.png') }}" alt="Fasteners and Hardware Icon" width="80" height="80" loading="lazy" style="margin-bottom:1rem;">
                <h4 style="color:#004d40; margin-bottom:0.75rem;">Fasteners & Hardware</h4>
                <p style="color:#00695c; font-size:0.95rem;">
                    From nails, screws, and bolts to industrial-grade fasteners — we have what holds it all together.
                </p>
            </article>
        </div>
    </section>

    {{-- Product Filter --}}
    <section class="text-center" style="margin-bottom:2rem;">
        <form method="GET" action="{{ url('/') }}">
            <label for="category" style="font-weight:600; margin-right:0.5rem;">Filter by Category:</label>
            <select name="category" id="category" onchange="this.form.submit()" style="padding:0.4rem; border-radius:6px; border:1px solid #ccc;">
                <option value="" {{ request('category') == '' ? 'selected' : '' }}>All</option>
                <option value="farm_tools" {{ request('category') == 'farm_tools' ? 'selected' : '' }}>Farm Tools</option>
                <option value="plumbing" {{ request('category') == 'plumbing' ? 'selected' : '' }}>Plumbing Supplies</option>
                <option value="fasteners" {{ request('category') == 'fasteners' ? 'selected' : '' }}>Fasteners & Hardware</option>
            </select>
        </form>
    </section>

    {{-- Featured Products --}}
    <section aria-label="Featured Products" style="margin-bottom:3rem;">
        <h3 style="text-align:center; color:#00796b; font-weight:700; margin-bottom:2rem;" data-aos="fade-up">Featured Products</h3>

        <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:2rem;">
            @forelse($featuredProducts as $index => $product)
                <article 
                    tabindex="0" role="group" aria-label="{{ $product->name }} product"
                    style="width:220px; background:#fff; border-radius:8px; box-shadow:0 3px 10px rgba(0,0,0,0.1); overflow:hidden; transition: transform 0.25s ease; cursor:pointer;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 150 }}"
                >
                    <img src="{{ asset($product->image_path ?? 'images/placeholder.png') }}" alt="{{ $product->name }}" style="width:100%; height:150px; object-fit:cover;">
                    <div style="padding:1rem;">
                        <h4 style="margin-top:0; margin-bottom:0.5rem; color:#004d40;">{{ $product->name }}</h4>
                        <p style="margin:0 0 0.75rem; font-size:0.9rem; color:#666;">{{ Str::limit($product->description, 60) }}</p>
                        <strong style="color:#26a69a;">Ksh {{ number_format($product->price) }}</strong>
                    </div>
                </article>
            @empty
                <p style="text-align:center; color:#777;">No featured products available for this category.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($featuredProducts->hasPages())
            <div style="margin-top:2rem; display:flex; justify-content:center;">
                {{ $featuredProducts->withQueryString()->links('pagination::simple-default') }}
            </div>
        @endif
    </section>

    {{-- Trusted Brands --}}
    <section aria-label="Trusted Brands" style="margin-bottom:3rem; text-align:center;">
        <h3 style="color:#00796b; font-weight:700; margin-bottom:2rem;" data-aos="fade-up">
            Trusted Brands
        </h3>
        <div style="display:flex; justify-content:center; flex-wrap:wrap; gap:2rem;">
            <img src="{{ asset('images/brand1.png') }}" alt="Brand 1" width="120" height="60"
                loading="lazy" style="object-fit:contain;" data-aos="zoom-in" data-aos-delay="100">
            <img src="{{ asset('images/brand2.png') }}" alt="Brand 2" width="120" height="60"
                loading="lazy" style="object-fit:contain;" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/brand3.png') }}" alt="Brand 3" width="120" height="60"
                loading="lazy" style="object-fit:contain;" data-aos="zoom-in" data-aos-delay="300">
            <img src="{{ asset('images/brand4.png') }}" alt="Brand 4" width="120" height="60"
                loading="lazy" style="object-fit:contain;" data-aos="zoom-in" data-aos-delay="400">
        </div>
    </section>

    {{-- Testimonials --}}
    <section aria-label="Customer Testimonials" style="margin-bottom:3rem;">
        <h3 style="text-align:center; color:#00796b; font-weight:700; margin-bottom:2rem;" data-aos="fade-up">What Our Customers Say</h3>
        <div style="max-width:900px; margin:0 auto; display:flex; flex-wrap:wrap; justify-content:center; gap:2rem;">
            <blockquote
                style="background:#e0f2f1; border-radius:12px; padding:1.5rem; width:280px; box-shadow:0 3px 10px rgba(0,0,0,0.1);"
                data-aos="fade-right"
                data-aos-delay="0"
            >
                <p style="font-style:italic; color:#004d40;">
                    "Pemba Hardware has consistently provided me with top-quality farm tools. Their service is fast and reliable."
                </p>
                <footer style="margin-top:1rem; font-weight:bold; color:#00695c;">— John Mwangi</footer>
            </blockquote>

            <blockquote
                style="background:#e0f2f1; border-radius:12px; padding:1.5rem; width:280px; box-shadow:0 3px 10px rgba(0,0,0,0.1);"
                data-aos="fade-right"
                data-aos-delay="200"
            >
                <p style="font-style:italic; color:#004d40;">
                    "The plumbing supplies I got here were exactly what I needed, and the prices are very fair."
                </p>
                <footer style="margin-top:1rem; font-weight:bold; color:#00695c;">— Sarah Njeri</footer>
            </blockquote>

            <blockquote
                style="background:#e0f2f1; border-radius:12px; padding:1.5rem; width:280px; box-shadow:0 3px 10px rgba(0,0,0,0.1);"
                data-aos="fade-right"
                data-aos-delay="400"
            >
                <p style="font-style:italic; color:#004d40;">
                    "Great selection of fasteners & hardware, and the staff were very helpful. Highly recommend!"
                </p>
                <footer style="margin-top:1rem; font-weight:bold; color:#00695c;">— Peter Otieno</footer>
            </blockquote>
        </div>
    </section>

    {{-- Call to Action --}}
    <section style="text-align:center; margin-bottom:2rem;" data-aos="fade-up">
        <h3 style="color:#00796b; font-weight:700; margin-bottom:1rem;">Need Help? Get in Touch!</h3>
        <p style="color:#004d40; font-size:1.1rem;">
            Call us at <a href="tel:0799029295" style="color:#26a69a; font-weight:700;">0799 029 295</a> or chat with us on 
            <a href="https://wa.me/254740884932" target="_blank" rel="noopener noreferrer" style="color:#26a69a; font-weight:700;">WhatsApp</a>.
        </p>
    </section>

</div>

{{-- AOS scripts --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
    });
  });
</script>

@endsection
