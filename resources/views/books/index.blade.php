<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-[#193c30] leading-tight">Daftar Buku</h2>
            @can('create-books')
                <a href="{{ route('books.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#193c30] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#285640]">
                    <span class="text-lg leading-none" aria-hidden="true">+</span>
                    Tambah Buku
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div role="status" class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-[#e3e9df] bg-white shadow-sm">
                <div class="overflow-x-auto p-6 text-gray-900">
                    @if ($books->isEmpty())
                        <div class="rounded-xl border border-dashed border-[#cbd9ca] bg-[#f4f7f1] px-6 py-12 text-center">
                            <p class="text-base font-semibold text-[#315846]">Koleksi masih kosong</p>
                            <p class="mt-2 text-sm text-gray-600">Buku yang tersedia akan muncul di halaman ini.</p>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                            <thead class="bg-[#f1f5ef] text-xs uppercase tracking-wide text-[#58705c]">
                                <tr>
                                    <th class="px-3 py-3">Judul</th>
                                    <th class="px-3 py-3">Penulis</th>
                                    <th class="px-3 py-3">Penerbit</th>
                                    <th class="px-3 py-3">Tahun</th>
                                    <th class="px-3 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#edf0e9]">
                                @foreach ($books as $book)
                                    <tr class="transition hover:bg-[#f7f9f5]">
                                        <td class="px-3 py-4 font-semibold text-[#244b36]">{{ $book->judul }}</td>
                                        <td class="px-3 py-3">{{ $book->penulis }}</td>
                                        <td class="px-3 py-3">{{ $book->penerbit ?: '-' }}</td>
                                        <td class="px-3 py-3">{{ $book->tahun_terbit }}</td>
                                        <td class="px-3 py-3">
                                            <div class="flex flex-wrap gap-3">
                                                <a class="font-medium text-[#315846] hover:underline" href="{{ route('books.show', $book) }}">Detail</a>
                                                @can('edit-books')
                                                    <a class="font-medium text-[#8a6832] hover:underline" href="{{ route('books.edit', $book) }}">Edit</a>
                                                @endcan
                                                @can('delete-books')
                                                    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-red-700 hover:underline" type="submit">Hapus</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">{{ $books->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
