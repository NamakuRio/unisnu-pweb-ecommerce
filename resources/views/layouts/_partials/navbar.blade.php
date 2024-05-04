{{-- <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div>
                <div class="sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('category.index') }}"
                            class="@if (Illuminate\Support\Facades\Route::is('category.index')) bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium @else text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium @endif">Kategori</a>
                        <a href="{{ route('product.index') }}"
                            class="@if (Illuminate\Support\Facades\Route::is('product.index')) bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium @else text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium @endif">Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav> --}}

<div class="navbar bg-base-100">
    <div class="container mx-auto">
        <div class="flex-1">
            <a href="{{ url('/') }}" class="btn btn-ghost text-xl">eCommerce</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li>
                    <a href="{{ route('category.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('category.index')) bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium @else text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium @endif">Kategori</a>
                </li>
                <li>
                    <a href="{{ route('product.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('product.index')) bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium @else text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium @endif">Produk</a>
                </li>
            </ul>
        </div>
    </div>
</div>
