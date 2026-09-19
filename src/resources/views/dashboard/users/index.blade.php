@extends('layouts.app')

@section('title', 'Users')
    

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                    User Management
                </h1>

                <p class="mt-1 text-sm text-zinc-500">
                    Kelola akun pengguna dan hak akses sistem.
                </p>
            </div>

            @can('user.create')
                <a
                    href="{{ route('users.create') }}"
                    class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-200"
                >
                    + Tambah User
                </a>
            @endcan
        </div>


        {{-- Success --}}
        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Error --}}
        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif


        {{-- Table --}}
        <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-950">
                        <tr>
                            <th class="px-6 py-4 font-medium text-zinc-600 dark:text-zinc-400">
                                #
                            </th>

                            <th class="px-6 py-4 font-medium text-zinc-600 dark:text-zinc-400">
                                Nama
                            </th>

                            <th class="px-6 py-4 font-medium text-zinc-600 dark:text-zinc-400">
                                Email
                            </th>

                            <th class="px-6 py-4 font-medium text-zinc-600 dark:text-zinc-400">
                                Role
                            </th>

                            <th class="px-6 py-4 text-right font-medium text-zinc-600 dark:text-zinc-400">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">

                        @forelse ($users as $user)

                            <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">

                                <td class="px-6 py-4 text-zinc-500">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $user->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-zinc-500">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4">

                                    @foreach ($user->roles as $role)
                                        <span class="inline-flex rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-end gap-2">

                                        @can('user.view')
                                            <a
                                                href="{{ route('users.show', $user) }}"
                                                class="rounded-md px-3 py-1.5 text-xs font-medium text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800"
                                            >
                                                Detail
                                            </a>
                                        @endcan

                                        @can('user.update')
                                            <a
                                                href="{{ route('users.edit', $user) }}"
                                                class="rounded-md px-3 py-1.5 text-xs font-medium text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800"
                                            >
                                                Edit
                                            </a>
                                        @endcan

                                        @can('user.delete')
                                            @if ($user->id !== auth()->id())
                                                <form
                                                    action="{{ route('users.destroy', $user) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                                        class="rounded-md px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center text-sm text-zinc-500"
                                >
                                    Belum ada user.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if ($users->hasPages())
                <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                    {{ $users->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection