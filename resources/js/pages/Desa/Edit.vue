<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ item: Object });
const form = useForm({ id: props.item.id, nama_desa: props.item.nama_desa });
const submitData = () => { form.put(`/desa/${form.id}`); };
</script>

<template>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Desa</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Perbarui informasi desa/kelurahan di bawah ini</p>
        </div>

        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
            <form @submit.prevent="submitData" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Desa/Kelurahan</label>
                    <input
                        v-model="form.nama_desa"
                        type="text"
                        placeholder="Masukkan nama desa atau kelurahan..."
                        class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    <div v-if="form.errors.nama_desa" class="text-red-500 dark:text-red-400 text-xs mt-1">{{ form.errors.nama_desa }}</div>
                </div>
                <div class="flex gap-2 pt-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200 disabled:opacity-50"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Data
                    </button>
                    <Link
                        href="/desa"
                        class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200"
                    >
                        Batal
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>