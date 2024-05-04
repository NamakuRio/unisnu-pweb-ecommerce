@extends('layouts.main')

@section('title', 'Kategori - List')

@section('main')
    <div class="flex flex-col gap-4">
        @if (session('status') && session('message'))
            <div class="alert alert-{{ session('status') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="card w-full p-6 bg-base-100 shadow-xl">
            <div class="text-xl font-semibold inline-block">
                <h4 class="inline-block">Kategori</h4>
                <div class="inline-block float-right">
                    <div class="inline-block float-right">
                        <a href="{{ route('category.create') }}" class="btn px-6 btn-sm normal-case btn-primary">
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="divider mt-2"></div>
            <div class="h-full w-full pb-6 bg-base-100">
                <div class="overflow-x-auto w-full">
                    <table class="table w-full table-zebra">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Total Produk
                                </th>
                                <th>
                                    Tanggal Ditambahkan
                                </th>
                                <th>
                                    Terakhir Diperbarui
                                </th>
                                <th class="float-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) > 0)

                                @foreach ($categories as $key => $category)
                                    <tr class="hover">
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            <a href="{{ route('category.show', $category) }}"
                                                class="font-bold text-primary">
                                                {{ $category->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $category->products_count }}
                                        </td>
                                        <td>
                                            <div class="flex flex-col">
                                                <p>
                                                    {{ $category->created_at->isoFormat('DD MMMM YYYY') }}
                                                </p>
                                                <p>
                                                    {{ $category->created_at->isoFormat('HH:mm:ss') }} WIB
                                                </p>
                                                <small class="opacity-60">
                                                    {{ $category->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex flex-col">
                                                <p>
                                                    {{ $category->updated_at->isoFormat('DD MMMM YYYY') }}
                                                </p>
                                                <p>
                                                    {{ $category->updated_at->isoFormat('HH:mm:ss') }} WIB
                                                </p>
                                                <small class="opacity-60">
                                                    {{ $category->updated_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="float-end">
                                            <a href="{{ route('category.edit', $category) }}"
                                                class="btn px-4 btn-sm btn-info">
                                                Edit
                                            </a>
                                            <form action="{{ route('category.destroy', $category) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm px-4 btn-error"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-10">
                                        <h3>Belum ada Kategori</h3>
                                        <a href="{{ route('category.create') }}" class="text-primary">Tambahkan kategori
                                            baru</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
