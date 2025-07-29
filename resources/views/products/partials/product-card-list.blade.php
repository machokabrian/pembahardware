<div 
    class="flex flex-col sm:flex-row bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-md transition hover:shadow-xl"
    data-aos="fade-up"
>
    {{-- Image --}}
    <div class="sm:w-1/3 bg-gray-900 flex items-center justify-center h-48 sm:h-auto">
        <img 
            src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->name }}"
            class="object-contain max-h-full transition duration-300 hover:scale-105"
            loading="lazy"
        >
    </div>

    {{-- Details --}}
    <div class="sm:w-2/3 p-4 flex flex-col justify-between">
        <div>
            <h3 class="text-base font-semibold text-gray-100 mb-1">{{ $product->name }}</h3>

            <div class="text-blue-400 font-bold text-lg mb-2">
                KSh {{ number_format($product->price) }}
            </div>

            <p class="text-sm text-gray-400 line-clamp-2">
                {{ $product->description }}
            </p>
        </div>

        <div class="flex flex-wrap items-center justify-between mt-4 gap-2">
            @if($product->in_stock)
                <span class="text-green-400 text-xs font-medium">✔ In Stock</span>
            @else
                <span class="text-red-400 text-xs font-medium">✖ Out of Stock</span>
            @endif

            <div class="flex gap-2">
                <button 
                    class="preview-button bg-gray-700 hover:bg-gray-600 text-sm text-white px-4 py-1.5 rounded-md transition"
                    data-id="{{ $product->id }}"
                >
                    Preview
                </button>

                <button 
                    class="add-to-cart bg-blue-600 hover:bg-blue-700 text-sm text-white px-4 py-1.5 rounded-md transition"
                    data-id="{{ $product->id }}"
                >
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>
