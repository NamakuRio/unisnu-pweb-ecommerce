@extends('layouts.main')

@section('title', 'Produk - List')

@section('main')
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold">Produk</h1>
            <a href="{{ route('product.create') }}" class="btn btn-md px-6 normal-case btn-primary">Tambah Produk Baru</a>
        </div>
        @if (session('status') && session('message'))
            <div class="alert alert-{{ session('status') }}">
                {{ session('message') }}
            </div>
        @endif
        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center h-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-64 h-64 text-gray-400 mb-4" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 19c-5.523 0-10-4.477-10-10s4.477-10 10-10 10 4.477 10 10-4.477 10-10 10zm0-18c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zM6 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0-4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0-4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                </svg>
                <p class="text-gray-500 text-lg mb-4">Belum ada produk.</p>
                <a href="{{ route('product.create') }}" class="btn btn-md px-6 normal-case btn-primary">Tambah Produk
                    Baru</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="card shadow-xl bg-base-100 hover:scale-105 transition-all duration-300 active:scale-95">
                        <figure>
                            <img src="{{ $product?->photo_url ? url('storage/product_images/' . $product?->photo_url) : url('assets/images/default-photo-product.svg') }}"
                                alt="{{ $product->name }}"
                                class="w-full h-48 {{ $product?->photo_url ? 'object-cover' : 'object-contain' }} bg-white ">
                        </figure>
                        <div class="card-body">
                            <a href="{{ route('product.show', $product) }}" class="card-title text-primary">
                                {{ $product->name }}
                                <div class="badge badge-outline badge-accent">
                                    {{ $product->category->name }}
                                </div>
                            </a>
                            <p class="text-lg font-semibold mt-4">Rp.{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>
                            <div class="card-actions justify-end">
                                <a href="{{ route('product.edit', $product) }}" class="btn btn-sm px-6 btn-info">Edit</a>
                                <form action="{{ route('product.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm px-6 btn-error"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
