@extends('layouts.main')

@section('title', "Kategori - Detail {$category?->name}")

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
                        <a href="{{ route('category.index') }}" class="btn btn-sm normal-case btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M19 12H6M12 5l-7 7 7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <h4 class="inline-block">Detail {{ $category?->name }}</h4>
                <div class="inline-block float-right">
                    <div class="inline-block float-right">
                        <a href="{{ route('category.edit', $category) }}" class="btn px-6 btn-sm normal-case btn-info">
                            Edit
                        </a>
                        <form action="{{ route('category.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm px-6 normal-case btn-error"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="divider mt-2"></div>
            <div class="h-full w-full pb-6 bg-base-100">
                <div class="overflow-x-auto w-full">
                    <div class="flex flex-col gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-base-content">Nama Kategori :</span>
                            </label>
                            <p class="ml-1">{{ $category->name }}</p>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-base-content">Total Produk :</span>
                            </label>
                            <p class="ml-1">{{ $category->products->count() }}</p>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-base-content">Tanggal Ditambahkan:</span>
                            </label>
                            <p class="ml-1">{{ $category->created_at->isoFormat('DD MMMM YYYY [pukul] HH:mm:ss [WIB]') }}
                            </p>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-base-content">Terakhir Diperbarui:</span>
                            </label>
                            <p class="ml-1">{{ $category->updated_at->isoFormat('DD MMMM YYYY [pukul] HH:mm:ss [WIB]') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
