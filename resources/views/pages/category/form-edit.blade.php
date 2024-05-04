@extends('layouts.main')

@section('title', "Kategori - Edit {$category->name}")

@section('main')
    <div class="card w-1/2 p-6 bg-base-100 shadow-xl">
        <div class="text-xl font-semibold inline-block">
            <div class="inline-block float-left mr-2">
                <div class="inline-block float-right">
                    <a href="{{ route('category.index') }}" class="btn btn-sm normal-case btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H6M12 5l-7 7 7 7" />
                        </svg>

                    </a>
                </div>
            </div>
            <h4 class="inline-block">Edit {{ $category->name }}</h4>
        </div>
        <div class="divider mt-2"></div>
        <form action="{{ route('category.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="h-full w-full pb-6 bg-base-100">
                <div class="flex flex-col gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content undefined">
                                Nama Kategori
                            </span>
                        </label>
                        <input type="text" placeholder="Masukkan Nama Kategori" class="input input-bordered w-full"
                            name="name" value="{{ $category->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
