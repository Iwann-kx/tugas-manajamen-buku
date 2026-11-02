<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#193c30] leading-tight">Detail Buku</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4 rounded-2xl border border-[#e3e9df] bg-white p-6 shadow-sm sm:p-8">
                <span class="inline-flex rounded-full bg-[#e8eee8] px-3 py-1 text-xs font-semibold text-[#315846]">INFORMASI BUKU</span>
                <h3 class="text-2xl font-semibold text-[#193c30]">{{ $book->judul }}</h3>
                <p><span class="font-medium">Penulis:</span> {{ $book->penulis }}</p>
                <p><span class="font-medium">Penerbit:</span> {{ $book->penerbit ?: '-' }}</p>
                <p><span class="font-medium">Tahun terbit:</span> {{ $book->tahun_terbit }}</p>
                <div>
                    <p class="font-medium">Deskripsi:</p>
                    <p class="mt-1 whitespace-pre-line text-gray-700">{{ $book->deskripsi ?: '-' }}</p>
                </div>
                <div class="flex gap-4 pt-2">
                    <a href="{{ route('books.index') }}" class="font-medium text-[#315846] hover:underline">Kembali ke daftar</a>
                    @can('edit-books')
                        <a href="{{ route('books.edit', $book) }}" class="font-medium text-[#8a6832] hover:underline">Edit buku</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
