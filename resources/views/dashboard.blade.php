<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#193c30] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-6 sm:px-6 lg:px-8">
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#193c30] via-[#285640] to-[#50775b] p-7 text-white shadow-lg sm:p-10">
                <div class="absolute -right-10 -top-20 h-64 w-64 rounded-full border border-white/10"></div>
                <div class="absolute -right-2 -top-12 h-48 w-48 rounded-full border border-white/10"></div>
                <div class="relative max-w-2xl">
                    <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-[#e2ecdc] ring-1 ring-white/15">DASHBOARD</span>
                    <p class="mt-5 text-3xl font-semibold tracking-tight sm:text-4xl">Selamat datang, {{ Auth::user()->name }}.</p>
                    <p class="mt-3 max-w-xl text-sm leading-6 text-white/75">Kelola koleksi buku dan akses fitur yang tersedia untuk akun Anda.</p>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-[#e6eee0] px-3 py-1.5 text-xs font-bold text-[#244b36]">
                            {{ Auth::user()->getRoleNames()->implode(', ') ?: 'Belum ditetapkan' }}
                        </span>
                        <span class="text-xs text-white/60">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-[#e3e9df] bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#e8eee8] text-[#315846]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 5.5A2.5 2.5 0 0 1 7.5 3H20v16H7.5A2.5 2.5 0 0 0 5 21V5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                            <path d="M5 6v15m4-13h7m-7 4h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-[#193c30]">Koleksi Buku</h3>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Jelajahi katalog dan lihat informasi lengkap buku.</p>
                    @can('view-books')
                        <a href="{{ route('books.index') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#315846] hover:text-[#193c30]">
                            Buka katalog <span aria-hidden="true">→</span>
                        </a>
                    @endcan
                </div>
                @can('manage-roles')
                    <div class="rounded-2xl border border-[#e8e1d3] bg-gradient-to-br from-[#fffdf8] to-[#f5efe3] p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#efe5d2] text-[#8a6832]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m12-13a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm2 5a4 4 0 0 1 4 4v2m-4-15a4 4 0 0 1 0 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-[#193c30]">Pengguna &amp; Role</h3>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Atur role dan hak akses untuk pengguna aplikasi.</p>
                        <a href="{{ route('users.roles.index') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#80602f] hover:text-[#634923]">
                            Kelola pengguna <span aria-hidden="true">→</span>
                        </a>
                    </div>
                @endcan
            </section>
        </div>
    </div>
</x-app-layout>
