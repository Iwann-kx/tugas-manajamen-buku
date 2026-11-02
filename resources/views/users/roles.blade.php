<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#193c30] leading-tight">Kelola Role Pengguna</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div role="status" class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-[#e8e1d3] bg-white shadow-sm">
                <div class="overflow-x-auto p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-[#eee9df] text-left text-sm">
                        <thead class="bg-[#f7f3e9] text-xs uppercase tracking-wide text-[#80602f]">
                            <tr>
                                <th class="px-3 py-3">Nama</th>
                                <th class="px-3 py-3">Email</th>
                                <th class="px-3 py-3">Role saat ini</th>
                                <th class="px-3 py-3">Ubah role</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f0ede6]">
                            @foreach ($users as $user)
                                <tr class="transition hover:bg-[#fcfbf7]">
                                    <td class="px-3 py-4 font-semibold text-[#244b36]">{{ $user->name }}</td>
                                    <td class="px-3 py-3">{{ $user->email }}</td>
                                    <td class="px-3 py-4">
                                        <span class="inline-flex rounded-full bg-[#e8eee8] px-2.5 py-1 text-xs font-semibold text-[#315846]">{{ $user->getRoleNames()->implode(', ') ?: '-' }}</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <form method="POST" action="{{ route('users.roles.update', $user) }}" class="flex flex-wrap items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" required class="rounded-lg border-[#d6dfd3] bg-[#fbfcfa] text-sm shadow-sm focus:border-[#709276] focus:ring-[#709276]">
                                                <option value="">Pilih role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" @selected(old('role', $user->getRoleNames()->first()) === $role->name)>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-primary-button>Simpan</x-primary-button>
                                        </form>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
