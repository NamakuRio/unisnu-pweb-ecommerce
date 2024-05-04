@extends('layouts.main')

@section('title', 'Detail Produk')

@section('main')
    <div class="flex flex-col gap-4">
        @if (session('status') && session('message'))
            <div class="alert alert-{{ session('status') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="card w-full p-6 bg-base-100 shadow-xl">
            <div class="text-xl font-semibold inline-block">
                <div class="inline-block float-left mr-2">
                    <div class="inline-block float-right">
                        <a href="{{ route('product.index') }}" class="btn btn-sm normal-case btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M19 12H6M12 5l-7 7 7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <h4 class="inline-block">Detail {{ $product->name }}</h4>
                <div class="inline-block float-right">
                    <div class="inline-block float-right">
                        <a href="{{ route('product.edit', $product) }}" class="btn px-6 btn-sm normal-case btn-info">
                            Edit
                        </a>
                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm px-6 normal-case btn-error"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="divider mt-2"></div>
            <div class="h-full w-full pb-6 bg-base-100">
                <div class="flex flex-col gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Nama :
                            </span>
                        </label>
                        <p class="ml-1">{{ $product->name }}</p>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Kategori :
                            </span>
                        </label>
                        <p class="ml-1">{{ $product->category->name }}</p>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Harga :
                            </span>
                        </label>
                        <p class="ml-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Stok :
                            </span>
                        </label>
                        <p class="ml-1">{{ $product->stock }}</p>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Foto Produk :
                            </span>
                        </label>
                        <img src="{{ $product?->photo_url ? url('storage/product_images/' . $product?->photo_url) : url('assets/images/default-photo-product.svg') }}"
                            alt="{{ $product->name }}"
                            class="w-full h-48 {{ $product?->photo_url ? 'object-contain' : 'object-contain' }} bg-white rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
