<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({ user: Object, ledgers: Array })
</script>

<template>
    <AppLayout title="Ledgers">
        <template #header>
            <div class="flex flex-row justify-normal space-x-4 px-10">
                <div class="inline-block">
                    <h2 class="font-semibold text-xl text-amber-800">
                        Ledgers
                    </h2>
                </div>

                <div class="inline-block">
                    <Link :href="route('ledgers.create')" class="shrink-0">
                        <h2 class="font-semibold text-xl text-green-400">
                            <button type="button">
                                New Ledger
                            </button>
                        </h2>
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12 px-2">
            <div class="max-w-7xl mx-auto">
                <div class="table table-auto max-w-3xl">
                    <div class="table-header-group">
                        <div class="table-row">
                            <div class="table-cell text-left pl-2">Book name</div>
                            <div class="table-cell text-center px-2">Date created</div>
                            <div class="table-cell text-center px-2">Income</div>
                            <div class="table-cell text-center px-2">Expenses</div>
                            <div class="table-cell text-center px-2">Balance</div>
                        </div>
                    </div>
                    <div class="table-row-group">
                        <!-- <div class="table-row" v-for="legder in ledgers.data">
                            <div class="table-cell text-left pl-2">{{ ledger.name }}</div>
                            <div class="table-cell text-left pl-2">{{ ledger.created_at }}</div>
                            <div class="table-cell text-left pl-2">{{ ledger.income }}</div>
                            <div class="table-cell text-left pl-2">{{ ledger.expenses }}</div>
                            <div class="table-cell text-left pl-2">{{ ledger.balance }}</div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>