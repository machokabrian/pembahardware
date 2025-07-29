<div 
    x-data="productModal()" 
    x-show="open" 
    x-cloak 
    x-transition.opacity.duration.400ms
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
    @keydown.escape.window="close"
    id="product-preview-modal"
    data-aos="zoom-in"
>
    <!-- Floating Close Button -->
    <button 
        @click="close"
        class="absolute top-4 right-4 z-50 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-full p-2 shadow hover:text-red-600 transition"
        aria-label="Close Modal"
    >
        <i class="bi bi-x-lg"></i>
    </button>

    <!-- Modal Box -->
    <div 
        @click.away="close"
        x-transition
        class="bg-white dark:bg-gray-900 w-full max-w-4xl mx-auto rounded-lg shadow-lg overflow-hidden relative"
    >
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100" x-text="product.name"></h2>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <!-- Image Carousel with Skeleton -->
            <div>
                <template x-if="loading">
                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 animate-pulse rounded-lg"></div>
                </template>

                <template x-if="!loading">
                    <div x-data="{ current: 0 }" class="relative">
                        <div class="overflow-hidden rounded-lg">
                            <img 
                                :src="product.images[current] || '{{ asset('images/fallback.jpg') }}'" 
                                :alt="product.name"
                                class="w-full h-64 object-cover transition duration-300 ease-in-out"
                                loading="lazy"
                            >
                        </div>

                        <!-- Thumbnails -->
                        <div class="flex space-x-2 mt-3">
                            <template x-for="(img, index) in product.images" :key="index">
                                <img 
                                    :src="img" 
                                    class="w-12 h-12 object-cover border-2 cursor-pointer rounded hover:opacity-80"
                                    :class="{ 'border-blue-600': current === index }"
                                    @click="current = index"
                                    loading="lazy"
                                >
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-between">
                <template x-if="loading">
                    <div>
                        <div class="h-4 w-3/4 bg-gray-300 dark:bg-gray-700 animate-pulse mb-2 rounded"></div>
                        <div class="h-4 w-1/2 bg-gray-300 dark:bg-gray-700 animate-pulse mb-4 rounded"></div>
                        <div class="h-4 w-full bg-gray-300 dark:bg-gray-700 animate-pulse mb-2 rounded"></div>
                        <div class="h-4 w-2/3 bg-gray-300 dark:bg-gray-700 animate-pulse rounded"></div>
                    </div>
                </template>

                <template x-if="!loading">
                    <div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm leading-relaxed" x-text="product.description"></p>
                        
                        <div class="mb-4">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400" x-text="'KSh ' + Number(product.price).toLocaleString()"></span>
                        </div>

                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            Availability: <span x-text="product.in_stock ? 'In Stock' : 'Out of Stock'"></span>
                        </div>
                    </div>
                </template>

                <!-- Add to Cart -->
                <form 
                    method="POST" 
                    :action="'/cart/add/' + product.id"
                    class="mt-4"
                >
                    @csrf
                    <button 
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition"
                        :disabled="!product.in_stock || loading"
                    >
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function productModal() {
        return {
            open: false,
            loading: true,
            product: {
                id: null,
                name: '',
                description: '',
                price: 0,
                in_stock: false,
                images: []
            },
            show(productData) {
                this.loading = true;
                this.open = true;

                // Simulate load delay for skeleton
                setTimeout(() => {
                    this.product = {
                        ...productData,
                        images: productData.images?.length ? productData.images : [productData.image]
                    };
                    this.loading = false;
                }, 300);
            },
            close() {
                this.open = false;
                this.product = {};
                this.loading = true;
            }
        };
    }

    function showProductModal(productId) {
        fetch(`/products/preview/${productId}`)
            .then(response => response.json())
            .then(data => {
                const modal = document.querySelector('#product-preview-modal');
                if (modal && modal.__x) {
                    modal.__x.$data.show(data);
                }
            })
            .catch(err => console.error('Preview fetch failed:', err));
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.preview-button').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                showProductModal(id);
            });
        });
    });
</script>
