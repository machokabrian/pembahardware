@extends('layouts.app')

@section('content')
<div x-data="productPage()" x-init="init()" class="bg-gray-900 text-gray-100 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    {{-- Main container --}}
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">

        {{-- Sidebar Filters --}}
        <aside
            class="w-full lg:w-1/4 space-y-4"
            x-show="filterOpen || window.innerWidth >= 1024"
            x-transition
            x-cloak
            data-aos="fade-right"
        >
            <form method="GET" action="{{ route('products.index') }}" class="space-y-4">

                {{-- Search --}}
                <div>
                    <label for="search" class="block text-sm text-gray-300 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-md px-3 py-2"
                        placeholder="Search products...">
                </div>

                {{-- Categories --}}
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Categories</label>
                    @foreach($categories as $category)
                        <label class="inline-flex items-center space-x-2 text-sm text-gray-200">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                class="form-checkbox rounded text-blue-600">
                            <span>{{ $category->name }}</span>
                        </label><br>
                    @endforeach
                </div>

                {{-- Availability --}}
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Availability</label>
                    <label class="inline-flex items-center space-x-2 text-sm text-gray-200">
                        <input type="checkbox" name="availability" value="1"
                            {{ request('availability') ? 'checked' : '' }}
                            class="form-checkbox rounded text-green-500">
                        <span>In Stock Only</span>
                    </label>
                </div>

                {{-- Price Range --}}
                <div class="flex space-x-2">
                    <div class="flex-1">
                        <label for="price_min" class="block text-sm text-gray-300 mb-1">Min Price</label>
                        <input type="number" name="price_min" value="{{ request('price_min') }}"
                            class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-md px-3 py-2">
                    </div>
                    <div class="flex-1">
                        <label for="price_max" class="block text-sm text-gray-300 mb-1">Max Price</label>
                        <input type="number" name="price_max" value="{{ request('price_max') }}"
                            class="w-full bg-gray-800 border border-gray-700 text-white text-sm rounded-md px-3 py-2">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md transition">
                        Apply Filters
                    </button>
                </div>
            </form>
        </aside>

        {{-- Main Content --}}
        <section class="w-full lg:w-3/4 space-y-6" data-aos="fade-up">

            {{-- Sort & View Toggle --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <form method="GET" class="flex items-center space-x-2">
                    {{-- Preserve filters --}}
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="availability" value="{{ request('availability') }}">
                    <input type="hidden" name="view" value="{{ request('view') }}">
                    @foreach(request('categories', []) as $cat)
                        <input type="hidden" name="categories[]" value="{{ $cat }}">
                    @endforeach
                    <input type="hidden" name="price_min" value="{{ request('price_min') }}">
                    <input type="hidden" name="price_max" value="{{ request('price_max') }}">

                    <label for="sort" class="text-sm">Sort by:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()"
                        class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-md px-3 py-2">
                        <option value="">Default</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </form>

                {{-- View Switcher --}}
                <div class="flex items-center space-x-2">
                    <button type="button"
                        @click="view = 'grid'; changeView('grid')"
                        :class="view === 'grid' ? 'bg-blue-600 text-white' : 'bg-gray-800 text-gray-300'"
                        class="px-4 py-2 text-sm font-medium rounded-md border border-gray-700 transition">
                        Grid View
                    </button>
                    <button type="button"
                        @click="view = 'list'; changeView('list')"
                        :class="view === 'list' ? 'bg-blue-600 text-white' : 'bg-gray-800 text-gray-300'"
                        class="px-4 py-2 text-sm font-medium rounded-md border border-gray-700 transition">
                        List View
                    </button>
                </div>
            </div>

            {{-- Product Listing --}}
            <div
                class="grid gap-6"
                :class="view === 'grid' ? 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3' : 'grid-cols-1'"
            >
                @forelse($products as $product)
                    @if(request('view') === 'list')
                        @include('products.partials.product-card-list', ['product' => $product])
                    @else
                        @include('products.partials.product-card', ['product' => $product])
                    @endif
                @empty
                    <div class="col-span-full text-gray-400 text-center py-12 text-lg">
                        No products found.
                        <a href="{{ route('home') }}" class="text-blue-400 underline hover:text-blue-300 ml-2">Browse categories</a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="pt-6 text-gray-300">
                {{ $products->appends(request()->query())->links('vendor.pagination.tailwind') }}
            </div>
        </section>
    </div>
</div>

{{-- Preview Modal --}}
@include('products.partials.preview-modal')

{{-- Cart Toast --}}
<div
    x-data="{ show: false, message: '' }"
    x-show="show"
    x-transition
    x-cloak
    x-init="$watch('show', value => value && setTimeout(() => show = false, 3000))"
    class="fixed bottom-4 right-4 z-50 bg-green-600 text-white text-sm px-4 py-3 rounded-lg shadow-lg"
    id="cartToast"
    x-text="message"
></div>

{{-- Scripts --}}
<script>
    function productPage() {
        return {
            view: '{{ request("view", "grid") }}',
            filterOpen: false,

            init() {
                // Swipe for filters
                let startX = 0, endX = 0;
                window.addEventListener('touchstart', e => startX = e.changedTouches[0].screenX);
                window.addEventListener('touchend', e => {
                    endX = e.changedTouches[0].screenX;
                    if (startX < 50 && endX - startX > 60) this.filterOpen = true;
                    if (startX > 250 && startX - endX > 60) this.filterOpen = false;
                });
            }
        };
    }

    function changeView(view) {
        const url = new URL(window.location.href);
        url.searchParams.set('view', view);
        window.location.href = url.toString();
    }

    // Modal & AJAX
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.preview-button').forEach(button => {
            button.addEventListener('click', async () => {
                const productId = button.dataset.id;
                const modal = document.getElementById('productModal');
                const content = document.getElementById('modalContent');

                content.innerHTML = `
                    <div class="p-8 flex items-center justify-center h-[300px]">
                        <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                    </div>`;
                modal.classList.remove('hidden');

                try {
                    const res = await fetch(`/products/${productId}/preview`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    content.innerHTML = await res.text();
                } catch (err) {
                    content.innerHTML = '<div class="p-6 text-red-500">Failed to load product preview.</div>';
                }
            });
        });

        // AJAX Cart Add
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', async () => {
                const productId = button.dataset.id;
                try {
                    const res = await fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ product_id: productId, quantity: 1 })
                    });

                    const data = await res.json();
                    if (data.success) {
                        const toast = document.getElementById('cartToast').__x;
                        toast.message = data.message || 'Added to cart!';
                        toast.show = true;
                    }
                } catch (error) {
                    alert('Failed to add to cart.');
                }
            });
        });
    });

    function closeModal() {
        document.getElementById('productModal').classList.add('hidden');
    }
</script>
@endsection
