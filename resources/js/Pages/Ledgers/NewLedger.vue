<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps({ errors: Object })

const form = reactive({
    ledgerName: null,
    isBank: false,
    description: null,
    bankOwner: null,
    bankIban: null,
    bankBic: null,
});

function submit() {
    router.post(route('ledgers.store'), form);
}
</script>

<template>
    <AppLayout title="New Ledger">
        <header class="flex flex-row justify-between px-10">
            <h2 class="font-semibold text-xl text-amber-800">
                New Ledger
            </h2>
        </header>
        <div v-if="errors.general" class="font-semibold text-l text-red-500 px-10">
            {{ errors.general }}
        </div>

        <form @submit.prevent="submit">
            <div class="table table-auto max-w-3xl">
                <div class="table-row">
                    <div class="table-cell px-2 py-1">
                        <InputLabel value="Ledger Name" for="ledgerName"/>
                    </div>
                    <div class="table-cell px-2 py-1">
                        <TextInput name="ledgerName" id="ledgerName" placeholder="Ledger / Bank name" v-model="form.ledgerName" />
                        <InputError v-if="errors" :message="errors.ledgerName" class="mt-2" />
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell px-2 py-1">
                        <InputLabel value="Is it a bank?" for="ledgerIsBank"/>
                    </div>
                    <div class="table-cell px-2 py-1">
                        <Checkbox name="isBank" id="ledgerIsBank" :ref="'isBank'" v-model="form.isBank" />
                        <InputError v-if="errors" :message="errors.isBank" class="mt-2" />
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell px-2 py-1">
                        <InputLabel value="Description" for="ledgerDescription"/>
                    </div>
                    <div class="table-cell px-2 py-1">
                        <TextInput name="description" id="ledgerDescription" placeholder="Comments about this ledger" v-model="form.description" />
                        <InputError v-if="errors" :message="errors.description" class="mt-2" />
                    </div>
                </div>

                <!-- section shown for bank type ledgers -->
                <div class="table-row-group" v-if="form.isBank">
                    <div class="table-row">
                        <div class="table-cell px-2 py-1">
                            <InputLabel value="Bank Owner" for="ledgerOwner"/>
                        </div>
                        <div class="table-cell px-2 py-1">
                            <TextInput name="bankOwner" id="ledgerOwner" placeholder="Account Owner Name" v-model="form.bankOwner" />
                        </div>
                    </div>
                    <div class="table-row">
                        <div class="table-cell px-2 py-1">
                            <InputLabel value="IBAN" for="ledgerIBAN"/>
                        </div>
                        <div class="table-cell px-2 py-1">
                            <TextInput name="bankIban" id="ledgerIBAN" v-model="form.bankIban" />
                        </div>
                    </div>
                    <div class="table-row">
                        <div class="table-cell px-2 py-1">
                            <InputLabel value="BIC" for="ledgerBIC"/>
                        </div>
                        <div class="table-cell px-2 py-1">
                            <TextInput name="bankBic" id="ledgerBIC" v-model="form.bankBic" />
                        </div>
                    </div>
                </div>
                <!-- end section -->
            </div>

            <button
                class="ml-4 my-4 px-4 py-px font-medium text-ellipsis text-nowrap border-2 border-y-green-200 border-x-green-400 rounded-xl"
                type="submit"
                :disabled="form.processing"
            >Save</button>
        </form>
    </AppLayout>
</template>
