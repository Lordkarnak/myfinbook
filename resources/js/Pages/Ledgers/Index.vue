<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({ user: Object, ledgers: Array })
</script>

<template>
    <AppLayout title="Ledgers">
        <header>
            <div class="flex flex-row justify-normal space-x-4 px-10">
                <div class="inline-block">
                    <h2 class="font-semibold text-xl text-amber-800">
                        Ledgers
                    </h2>
                </div>

                <div class="inline-block">
                    <Link :href="route('ledgers.create')" class="shrink-0">
                        <h2 class="font-semibold text-xl text-green-400">
                            <button type="button" class="text-neutral-700 font-semibold border-2 border-y-green-200 border-x-green-400 bg-neutral-50 rounded-3xl px-2 py-1">
                                New Ledger
                            </button>
                        </h2>
                    </Link>
                </div>
            </div>
        </header>

        <div class="py-12 px-2">
            <div class="max-w-7xl mx-auto">
                <div class="table table-auto max-w-3xl border-collapse">
                    <div v-if="!ledgers">
                        <div class="table-row">
                            <div class="table-cell">There is no data to display. Create a ledger to list activities and get insights.</div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="table-header-group text-xl">
                            <div class="table-row border-b-2 border-b-slate-400">
                                <div class="table-cell text-left px-2">Book name</div>
                                <div class="table-cell text-center px-2 border-x-2 border-x-slate-400">Date created</div>
                                <div class="table-cell text-center px-2 border-x-2 border-x-slate-400">Income</div>
                                <div class="table-cell text-center px-2 border-x-2 border-x-slate-400">Expenses</div>
                                <div class="table-cell text-center px-2">Balance</div>
                            </div>
                        </div>
                        <div class="table-row-group text-lg">
                            <a v-for="ledger in ledgers"
                                v-bind:href="ledger.url"
                                class="table-row py-2 w-full h-full cursor-pointer border-b-2 border-b-slate-400 hover:bg-sky-400 hover:bg-opacity-50 hover:font-semibold"
                            >
                                <div class="table-cell text-left pl-2">{{ ledger.name }}</div>
                                <div class="table-cell text-center pl-2">{{ ledger.created_at }}</div>
                                <div class="table-cell text-center pl-2">{{ ledger.income }}</div>
                                <div class="table-cell text-center pl-2">{{ ledger.expenses }}</div>
                                <div class="table-cell text-center pl-2">{{ ledger.balance }}</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
