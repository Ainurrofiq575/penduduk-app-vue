<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    desas: Array
});

const form = useForm({
    nama_lengkap: '',
    usia: '',
    jenis_kelamin: '',
    desa_id: ''
});

const submitData = () => {
    form.post('/penduduk');
};
</script>

<template>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <Link
                href="/penduduk"
                class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </Link>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Warga Baru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Isi formulir di bawah untuk mendaftarkan warga baru</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-800 dark:text-gray-200">Informasi Warga</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Semua field wajib diisi</p>
            </div>

            <form @submit.prevent="submitData" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Lengkap</label>
                        <input
                            v-model="form.nama_lengkap"
                            type="text"
                            placeholder="Contoh: Budi Santoso"
                            class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.nama_lengkap ? 'border-red-400 dark:border-red-500' : 'border-gray-200 dark:border-gray-600'"
                        >
                        <p v-if="form.errors.nama_lengkap" class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ form.errors.nama_lengkap }}
                        </p>
                    </div>

                    <!-- Usia -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Usia</label>
                        <div class="relative">
                            <input
                                v-model="form.usia"
                                type="number"
                                min="0"
                                placeholder="Minimal 17"
                                class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-14"
                                :class="form.errors.usia ? 'border-red-400 dark:border-red-500' : 'border-gray-200 dark:border-gray-600'"
                            >
                            <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">tahun</span>
                        </div>
                        <p v-if="form.errors.usia" class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ form.errors.usia }}
                        </p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Jenis Kelamin</label>
                        <select
                            v-model="form.jenis_kelamin"
                            class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.jenis_kelamin ? 'border-red-400 dark:border-red-500' : 'border-gray-200 dark:border-gray-600'"
                        >
                            <option value="" disabled>Pilih jenis kelamin...</option>
                            <option value="L">♂ Laki-laki</option>
                            <option value="P">♀ Perempuan</option>
                        </select>
                        <p v-if="form.errors.jenis_kelamin" class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ form.errors.jenis_kelamin }}
                        </p>
                    </div>

                    <!-- Desa -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Domisili Kelurahan/Desa</label>
                        <select
                            v-model="form.desa_id"
                            class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.desa_id ? 'border-red-400 dark:border-red-500' : 'border-gray-200 dark:border-gray-600'"
                        >
                            <option value="" disabled>Pilih kelurahan/desa...</option>
                            <option v-for="desa in desas" :key="desa.id" :value="desa.id">{{ desa.nama_desa }}</option>
                        </select>
                        <p v-if="form.errors.desa_id" class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ form.errors.desa_id }}
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center gap-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 disabled:opacity-60 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-colors duration-200"
                    >
                        <!-- Jika processing true, munculkan SVG putar animasi -->
                        <svg v-if="form.processing" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Data' }}
                    </button>
                    <Link
                        href="/penduduk"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200"
                    >
                        Batal
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>