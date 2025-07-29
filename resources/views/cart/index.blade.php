@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">🛒 Your Shopping Cart</h1>

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    @if(count($cart))
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 text-sm text-left">
                        <th class="p-4">Product</th>
                        <th class="p-4 text-right">Price</th>
                        <th class="p-4 text-center">Quantity</th>
                        <th class="p-4 text-right">Subtotal</th>
                        <th class="p-4 text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 flex items-center gap-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded" loading="lazy">
                                <div>
                                    <p class="font-semibold">{{ $item['name'] }}</p>
                                </div>
                            </td>
                            <td class="p-4 text-right text-gray-700">KSh {{ number_format($item['price']) }}</td>
                            <td class="p-4 text-center text-gray-700">{{ $item['quantity'] }}</td>
                            <td class="p-4 text-right text-gray-700">KSh {{ number_format($subtotal) }}</td>
                            <td class="p-4 text-right">
                                <a href="{{ route('cart.remove', $item['id']) }}" class="text-red-500 hover:text-red-700 transition">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100">
                        <td colspan="3" class="p-4 text-right font-bold">Total</td>
                        <td class="p-4 text-right font-bold text-green-600">KSh {{ number_format($total) }}</td>
                        <td class="p-4"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center flex-wrap gap-4">
            <a href="{{ route('products.index') }}" class="btn inline-flex items-center text-sm px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                ← Continue Shopping
            </a>
            <div class="flex gap-3">
                <a href="{{ route('cart.clear') }}" class="btn text-sm px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded">
                    Clear Cart
                </a>
                <a href="#" class="btn text-sm px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                    Proceed to Checkout →
                </a>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 p-6 rounded text-yellow-800">
            <p>Your cart is currently empty.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                Browse Products
            </a>
        </div>
    @endif
</div>
@endsection
