<div 
    class="relative group bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-md transition hover:shadow-xl"
    data-aos="fade-up"
>
    {{-- Product Image --}}
    <div class="relative w-full h-48 bg-gray-900 flex items-center justify-center">
        <img 
            src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->name }}"
            class="object-contain max-h-full transition duration-300 group-hover:scale-105"
            loading="lazy"
        >
        
        {{-- Add to Cart Overlay --}}
        <button 
            class="absolute bottom-2 right-2 bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded-md opacity-0 group-hover:opacity-100 transition-all duration-200 add-to-cart"
            data-id="{{ $product->id }}"
        >
            Add to Cart
        </button>
    </div>

    {{-- Product Info --}}
    <div class="p-4 space-y-2">
        <h3 class="text-sm font-semibold text-gray-100 truncate">{{ $product->name }}</h3>

        <div class="text-blue-400 font-bold text-base">
            KSh {{ number_format($product->price) }}
        </div>

        @if($product->in_stock)
            <span class="text-green-400 text-xs font-medium">In Stock</span>
        @else
            <span class="text-red-400 text-xs font-medium">Out of Stock</span>
        @endif

        {{-- Preview Button --}}
        <div class="pt-3">
            <button 
                class="preview-button w-full text-center bg-gray-700 hover:bg-gray-600 text-sm text-white py-1.5 rounded-md transition"
                data-id="{{ $product->id }}"
            >
                Preview
            </button>
        </div>
    </div>
</div>
