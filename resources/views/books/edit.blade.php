<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#193c30] leading-tight">Edit Buku</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-[#e3e9df] bg-white p-6 shadow-sm sm:p-8">
                <form method="POST" action="{{ route('books.update', $book) }}">
                    @csrf
                    @method('PUT')
                    @include('books._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
