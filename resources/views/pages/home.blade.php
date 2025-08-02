@extends('layouts.app')

@section('title', "Pemba Hardware - Nairobi's Trusted Source for Tools & Hardware")

{{-- SEO Meta --}}
@section('meta')
<meta name="description" content="Pemba Hardware offers quality farm tools, plumbing supplies, and fasteners & hardware in Nairobi. Trusted, durable products to empower your work and home.">
@endsection

@section('content')
<main>

  {{-- Embedded Styles --}}
  <style>
    .categories-section {
      margin-bottom: 3rem;
    }

    .categories-title {
      text-align: center;
      color: #00796b;
      font-weight: 700;
      margin-bottom: 1.5rem;
      font-size: 1.75rem;
    }

    .categories-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      list-style: none;
      padding: 0;
    }

    .category-card {
      background: #e0f2f1;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      max-width: 250px;
      padding: 1.5rem;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
      text-decoration: none;
      color: inherit;
      cursor: pointer;
    }

    .category-card:hover,
    .category-card:focus {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .category-card i {
      color: #004d40;
      margin-bottom: 1rem;
    }

    .category-card h4 {
      color: #004d40;
      margin-bottom: 0.75rem;
      font-size: 1.25rem;
      font-weight: 700;
    }

    .category-card p {
      color: #00695c;
      font-size: 0.95rem;
    }

    .category-card:focus-visible {
      outline: 3px solid #26a69a;
    }

    @media (max-width: 600px) {
      .categories-grid {
        flex-direction: column;
        align-items: center;
      }

      .category-card {
        max-width: 100%;
      }
    }

    form#filter-form {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      justify-content: center;
    }

    form#filter-form label {
      font-weight: 600;
    }

    form#filter-form select {
      padding: 0.4rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      min-width: 180px;
    }

    form#filter-form button {
      background-color: #00796b;
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    form#filter-form button:hover,
    form#filter-form button:focus {
      background-color: #004d40;
    }

    .featured-products {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
    }

    .product-card {
      width: 220px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.25s ease;
      cursor: pointer;
    }

    .product-card:focus-visible {
      outline: 3px solid #26a69a;
    }

    .call-to-action a {
      color: #26a69a;
      font-weight: 700;
      text-decoration: none;
    }

    .call-to-action a:hover,
    .call-to-action a:focus {
      text-decoration: underline;
    }
  </style>

  {{-- Hero --}}
  <section class="text-center mb-5" aria-label="Welcome Message" data-aos="fade-down">
    <h2 style="color:#004d40; font-weight:700; font-size:2.25rem;">Welcome to Pemba Hardware</h2>
    <p style="font-size:1.125rem; max-width:600px; margin:0.5rem auto; color:#555;">
      Your trusted source for quality farm tools, plumbing supplies, and fasteners & hardware in Nairobi. We bring you durable products to empower your work and home.
    </p>
  </section>

  {{-- Categories --}}
  <section id="categories" class="categories-section" aria-label="Main Product Categories">
    <h3 class="categories-title" data-aos="fade-up">Our Main Categories</h3>
    <div class="categories-grid" role="list">
      <a href="{{ url('/category/farm_tools') }}" class="category-card" role="listitem" aria-label="Farm Tools category" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-tractor fa-5x" aria-hidden="true"></i>
        <h4>Farm Tools</h4>
        <p>Durable hoes, pangas, sprayers and other essential farming tools.</p>
      </a>
      <a href="{{ url('/category/plumbing_supplies') }}" class="category-card" role="listitem" aria-label="Plumbing Supplies category" data-aos="fade-right" data-aos-delay="200">
        <i class="fas fa-faucet fa-5x" aria-hidden="true"></i>
        <h4>Plumbing Supplies</h4>
        <p>Pipes, taps, connectors and fittings for all plumbing needs.</p>
      </a>
      <a href="{{ url('/category/fasteners') }}" class="category-card" role="listitem" aria-label="Fasteners and Hardware category" data-aos="fade-right" data-aos-delay="300">
        <i class="fas fa-screwdriver-wrench fa-5x" aria-hidden="true"></i>
        <h4>Fasteners & Hardware</h4>
        <p>Nails, screws, bolts, and industrial-grade fasteners available.</p>
      </a>
    </div>
  </section>

  {{-- Filter --}}
  <section class="text-center" style="margin-bottom:2rem;">
    <form method="GET" action="{{ url('/') }}" id="filter-form" aria-label="Filter products by category">
      <fieldset style="border:none; display:inline-flex; align-items:center; gap:0.5rem;">
        <legend class="sr-only">Filter products by category</legend>
        <label for="category">Filter by Category:</label>
        <select name="category" id="category">
          <option value="" {{ request('category') == '' ? 'selected' : '' }}>All</option>
          <option value="farm_tools" {{ request('category') == 'farm_tools' ? 'selected' : '' }}>Farm Tools</option>
          <option value="plumbing_supplies" {{ request('category') == 'plumbing_supplies' ? 'selected' : '' }}>Plumbing Supplies</option>
          <option value="fasteners" {{ request('category') == 'fasteners' ? 'selected' : '' }}>Fasteners & Hardware</option>
        </select>
        <button type="submit">Apply</button>
      </fieldset>
    </form>
  </section>
{{-- Featured Products --}}
<section aria-label="Featured Products" style="margin-bottom:3rem;">
  <h3 style="text-align:center; color:#00796b; font-weight:700; margin-bottom:2rem;" data-aos="fade-up">Featured Products</h3>

  <div class="featured-products">
    @forelse($featuredProducts as $index => $product)
      <article tabindex="0" role="group" aria-label="{{ $product->name }} product"
        class="product-card" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}"
        onmouseenter="this.style.transform='scale(1.05)'" onmouseleave="this.style.transform='scale(1)'">
        
        <!-- Update image source to use primary image URL -->
        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}"
          style="width:100%; height:150px; object-fit:cover;" loading="lazy">
          
        <div style="padding:1rem;">
          <h4 style="color:#004d40;">{{ $product->name }}</h4>
          <p style="font-size:0.9rem; color:#666;">{{ Str::limit($product->description, 60) }}</p>
          <strong style="color:#26a69a;">Ksh {{ number_format($product->price, 2) }}</strong>
        </div>
      </article>
    @empty
      <p style="text-align:center; color:#777;">No featured products available for this category.</p>
    @endforelse
  </div>

  {{-- Pagination --}}
  @if ($featuredProducts->hasPages())
    <div style="margin-top:2rem; display:flex; justify-content:center;">
      {{ $featuredProducts->withQueryString()->links('vendor.pagination.bootstrap-4') }}
    </div>
  @endif
</section>


  {{-- Trusted Brands --}}
  <section aria-label="Trusted Brands" style="margin-bottom:3rem; text-align:center;">
  <h3 style="color:#00796b; font-weight:700; margin-bottom:2rem;" data-aos="fade-up">Trusted Brands</h3>
  <div style="display:flex; justify-content:center; flex-wrap:wrap; gap:2rem;">
    @for ($i = 1; $i <= 4; $i++)
      <img src="{{ asset("images/brands/brand{$i}.png") }}" alt="Brand {{ $i }}" width="120" height="60"
        loading="lazy" style="object-fit:contain;" 
        data-aos="flip-right" data-aos-delay="{{ $i * 100 }}" data-aos-duration="800">
    @endfor
  </div>
</section>


  {{-- Testimonials --}}
  <section aria-label="Customer Testimonials" style="margin-bottom:3rem;">
    <h3 style="text-align:center; color:#00796b; font-weight:700; margin-bottom:2rem;" data-aos="fade-up">What Our Customers Say</h3>
    <div style="max-width:900px; margin:0 auto; display:flex; flex-wrap:wrap; justify-content:center; gap:2rem;">
      @php
        $testimonials = [
          ['text' => "Pemba Hardware has consistently provided me with top-quality farm tools. Their service is fast and reliable.", 'author' => "John Mwangi"],
          ['text' => "The plumbing supplies I got here were exactly what I needed, and the prices are very fair.", 'author' => "Sarah Njeri"],
          ['text' => "Great selection of fasteners & hardware, and the staff were very helpful. Highly recommend!", 'author' => "Peter Otieno"]
        ];
      @endphp
      @foreach($testimonials as $index => $testimonial)
        <blockquote style="background:#e0f2f1; border-radius:12px; padding:1.5rem; width:280px; box-shadow:0 3px 10px rgba(0,0,0,0.1);" data-aos="fade-right" data-aos-delay="{{ $index * 200 }}">
          <p style="font-style:italic; color:#004d40;">"{{ $testimonial['text'] }}"</p>
          <footer style="margin-top:1rem; font-weight:bold; color:#00695c;">— {{ $testimonial['author'] }}</footer>
        </blockquote>
      @endforeach
    </div>
  </section>

  {{-- Call to Action --}}
  <section class="call-to-action" style="text-align:center; margin-bottom:2rem;" data-aos="fade-up">
    <h3 style="color:#00796b; font-weight:700; margin-bottom:1rem;">Need Assistance? We're Here to Help!</h3>
    <p style="color:#004d40; font-size:1.1rem;">
      Call us at <a href="tel:0799029295">0799 029 295</a> or chat with us on
      <a href="https://wa.me/254740884932" target="_blank" rel="noopener noreferrer">WhatsApp</a>.
    </p>
  </section>

</main>

{{-- AOS --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
  });
</script>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<!-- AOS JavaScript -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    AOS.init();
  });
</script>

@endsectionxx
