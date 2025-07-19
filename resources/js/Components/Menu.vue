<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { Link, router } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <h1 class="font-semibold text-xl text-slate-900 dark:text-white leading-tight">My finbook main menu</h1>
        </div>

        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-6 justify-items-center">
            <div>
                <Link :href="route('ledgers.index')">
                    <div class="border border-green-800 rounded-md text-center bg-slate-200 py-4 px-32">
                        <h2 class="font-semibold text-xl text-green-800 dark:text-green-200">
                            View Ledgers
                        </h2>
                    </div>
                </Link>
            </div>

            <div>
                <Link :href="route('statistics.index')">
                    <div class="border border-green-800 rounded-md text-center bg-slate-200 py-4 px-32">
                        <h2 class="font-semibold text-xl text-green-800 dark:text-green-200 text-opacity-20">
                            View Statistics
                        </h2>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
