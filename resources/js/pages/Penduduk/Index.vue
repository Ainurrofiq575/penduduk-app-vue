<script setup>
import { router, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    items: Array
});

const search = ref('');

const filteredItems = computed(() => {
    if (!search.value) return props.items;
    return props.items.filter(item =>
        item.nama_lengkap.toLowerCase().includes(search.value.toLowerCase()) ||
        (item.desa && item.desa.nama_desa.toLowerCase().includes(search.value.toLowerCase()))
    );
});

const totalLaki = computed(() => props.items.filter(i => i.jenis_kelamin === 'L').length);
const totalPerempuan = computed(() => props.items.filter(i => i.jenis_kelamin === 'P').length);

const deleteData = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus data warga ini?')) {
        router.delete(`/penduduk/${id}`);
    }
};
</script>

<template>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Data Penduduk</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola seluruh data warga yang terdaftar</p>
            </div>
            <Link
                href="/penduduk/create"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 shadow-sm"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Warga
            </Link>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Total Warga</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ items.length }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-sky-100 dark:bg-sky-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Laki-laki</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ totalLaki }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-pink-100 dark:bg-pink-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Perempuan</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ totalPerempuan }}</p>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <!-- Search Bar -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Cari nama atau kelurahan..."
                        class="w-full sm:w-72 pl-9 pr-4 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Domisili</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Usia</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        <tr
                            v-for="(item, index) in filteredItems"
                            :key="item.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                                        :class="item.jenis_kelamin === 'L' ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-400' : 'bg-pink-100 text-pink-700 dark:bg-pink-900/40 dark:text-pink-400'">
                                        {{ item.nama_lengkap.charAt(0).toUpperCase() }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ item.nama_lengkap }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="item.desa" class="inline-flex items-center gap-1 text-sm text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ item.desa.nama_desa }}
                                </span>
                                <span v-else class="text-xs text-gray-400 italic">Belum diatur</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ item.usia }} thn</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    v-if="item.jenis_kelamin === 'L'"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-900/40 dark:text-sky-400"
                                >
                                    ♂ Laki-laki
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800 dark:bg-pink-900/40 dark:text-pink-400"
                                >
                                    ♀ Perempuan
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <Link
                                        :href="`/penduduk/${item.id}/edit`"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 rounded-lg transition-colors duration-150"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteData(item.id)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-colors duration-150"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Empty State -->
                        <tr v-if="filteredItems.length === 0">
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">
                                        {{ search ? 'Tidak ada warga yang cocok dengan pencarian' : 'Belum ada data penduduk' }}
                                    </p>
                                    <Link v-if="!search" href="/penduduk/create" class="text-sm text-blue-600 hover:underline">
                                        + Tambahkan warga pertama
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer info -->
            <div v-if="filteredItems.length > 0" class="px-6 py-3 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-400 dark:text-gray-500">
                Menampilkan {{ filteredItems.length }} dari {{ items.length }} data warga
            </div>
        </div>
    </div>
</template>