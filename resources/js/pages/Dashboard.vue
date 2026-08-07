<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineProps<{
    stats: {
        total_penduduk: number;
        total_laki: number;
        total_perempuan: number;
        total_desa: number;
    };
    pendudukTerbaru: Array<{
        id: number;
        nama_lengkap: string;
        usia: number;
        jenis_kelamin: string;
        desa: { nama_desa: string } | null;
        created_at: string;
    }>;
    perDesa: Array<{
        id: number;
        nama_desa: string;
        penduduks_count: number;
    }>;
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-1">

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <!-- Total Penduduk -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Penduduk</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-0.5">{{ stats.total_penduduk }}</p>
                </div>
            </div>

            <!-- Laki-laki -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-sky-100 dark:bg-sky-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Laki-laki</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-0.5">{{ stats.total_laki }}</p>
                    <p v-if="stats.total_penduduk > 0" class="text-xs text-sky-600 dark:text-sky-400 mt-0.5">
                        {{ Math.round((stats.total_laki / stats.total_penduduk) * 100) }}% dari total
                    </p>
                </div>
            </div>

            <!-- Perempuan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-pink-100 dark:bg-pink-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Perempuan</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-0.5">{{ stats.total_perempuan }}</p>
                    <p v-if="stats.total_penduduk > 0" class="text-xs text-pink-600 dark:text-pink-400 mt-0.5">
                        {{ Math.round((stats.total_perempuan / stats.total_penduduk) * 100) }}% dari total
                    </p>
                </div>
            </div>

            <!-- Desa -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Desa/Kelurahan</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-0.5">{{ stats.total_desa }}</p>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

            <!-- Warga Terbaru -->
            <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Warga Terdaftar Terbaru</h2>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">5 pendaftaran terakhir</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <Link href="/penduduk/create" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Warga
                        </Link>
                        <Link href="/penduduk" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">
                            Lihat semua →
                        </Link>
                    </div>
                </div>

                <div v-if="pendudukTerbaru.length === 0" class="px-5 py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada data penduduk</p>
                    <Link href="/penduduk/create" class="mt-2 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        Tambahkan warga pertama →
                    </Link>
                </div>

                <ul v-else class="divide-y divide-gray-100 dark:divide-gray-700">
                    <li
                        v-for="penduduk in pendudukTerbaru"
                        :key="penduduk.id"
                        class="px-5 py-3.5 flex items-center gap-3 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition-colors"
                    >
                        <div
                            class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shrink-0"
                            :class="penduduk.jenis_kelamin === 'L'
                                ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-400'
                                : 'bg-pink-100 text-pink-700 dark:bg-pink-900/40 dark:text-pink-400'"
                        >
                            {{ penduduk.nama_lengkap.charAt(0).toUpperCase() }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ penduduk.nama_lengkap }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                {{ penduduk.usia }} tahun
                                <span v-if="penduduk.desa"> · {{ penduduk.desa.nama_desa }}</span>
                            </p>
                        </div>
                        <span
                            class="text-xs font-medium px-2 py-0.5 rounded-full shrink-0"
                            :class="penduduk.jenis_kelamin === 'L'
                                ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-400'
                                : 'bg-pink-100 text-pink-700 dark:bg-pink-900/40 dark:text-pink-400'"
                        >
                            {{ penduduk.jenis_kelamin === 'L' ? '♂ L' : '♀ P' }}
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Sebaran per Desa -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Sebaran per Desa</h2>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Jumlah warga tiap kelurahan</p>
                    </div>
                    <Link href="/desa" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">
                        Kelola →
                    </Link>
                </div>

                <div v-if="perDesa.length === 0" class="px-5 py-12 text-center">
                    <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada data desa</p>
                </div>

                <ul v-else class="divide-y divide-gray-100 dark:divide-gray-700 p-4 space-y-3">
                    <li v-for="desa in perDesa" :key="desa.id" class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ desa.nama_desa }}</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ desa.penduduks_count }}</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                            <div
                                class="bg-blue-500 h-1.5 rounded-full transition-all duration-500"
                                :style="{ width: stats.total_penduduk > 0 ? `${(desa.penduduks_count / stats.total_penduduk) * 100}%` : '0%' }"
                            ></div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>
