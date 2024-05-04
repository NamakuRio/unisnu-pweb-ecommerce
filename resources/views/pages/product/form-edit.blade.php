@extends('layouts.main')

@section('title', "Kategori - Edit {$product->name}")

@section('main')
    <div class="card w-1/2 p-6 bg-base-100 shadow-xl">
        <div class="text-xl font-semibold inline-block">
            <div class="inline-block float-left mr-2">
                <div class="inline-block float-right">
                    <a href="{{ route('product.index') }}" class="btn btn-sm normal-case btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H6M12 5l-7 7 7 7" />
                        </svg>

                    </a>
                </div>
            </div>
            <h4 class="inline-block">Edit {{ $product->name }}</h4>
        </div>
        <div class="divider mt-2"></div>
        <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="h-full w-full pb-6 bg-base-100">
                <div class="flex flex-col gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Kategori
                            </span>
                        </label>
                        <select name="category_id" class="select select-bordered w-full">
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $product->category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Nama Produk
                            </span>
                        </label>
                        <input type="text" placeholder="Masukkan Nama Produk" name="name"
                            class="input input-bordered w-full" value="{{ $product->name }}">
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Harga
                            </span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                            <input type="text" placeholder="Masukkan Harga" name="price"
                                class="pl-10 input input-bordered w-full" value="{{ $product->price }}">
                        </div>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Stok
                            </span>
                        </label>
                        <input type="text" placeholder="Masukkan Stok" name="stock" class="input input-bordered w-full"
                            value="{{ $product->stock }}">
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Foto Produk
                            </span>
                        </label>
                        <input type="file" name="photo" class="file-input input-bordered w-full"
                            value="{{ $product->photo_url }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
