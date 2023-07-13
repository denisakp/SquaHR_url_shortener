<script setup>
import { Input, Button } from "flowbite-vue";
import { useForm, Head } from "@inertiajs/vue3";
import DataTable from "@/Components/DataTable.vue";
import Alert from "@/Components/Alert.vue";
import Statistic from "@/Components/Statistic.vue";

const props = defineProps([
    "data",
    "message",
    "unique_visitors",
    "most_clicked",
]);

const form = useForm({ url: null });

const submit = () =>
    form.post("/shortener", {
        onSuccess: () => {
            form.reset();
        },
    });
</script>

<template>
    <div>
        <Head title="URL Shortener" />
        <div class="flex h-screen overflow-hidden">
            <div
                class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden"
            >
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <h1
                            class="text-3xl font-bold tracking-tight text-gray-900"
                        >
                            URL Shortener project
                        </h1>
                    </div>
                </header>

                <div class="mx-auto container max-w-7xl py-3 sm:px-6 lg:px-8">
                    <h2>Statistics</h2>
                    <div class="py-3">
                        <Statistic
                            :unique_visitors="unique_visitors"
                            :total="data.length"
                            :most_clicked="most_clicked"
                        />
                    </div>
                </div>

                <div class="mx-auto container max-w-7xl py-3 sm:px-6 lg:px-8">
                    <div class="space-y-12 p-4">
                        <form @submit.prevent="submit">
                            <Input
                                :class="[
                                    form.errors.url
                                        ? 'border-red-500 text-red-900 placeholder-red-700'
                                        : '',
                                ]"
                                v-model="form.url"
                                size="lg"
                                placeholder="Enter your the full url"
                                label="Create new Short URL"
                            >
                                <template #suffix>
                                    <Button
                                        :disabled="form.processing"
                                        type="submit"
                                        color="default"
                                        size="lg"
                                    >
                                        Create
                                    </Button>
                                </template>
                            </Input>
                            <p
                                v-if="form.errors.url"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ form.errors.url }}
                            </p>
                        </form>
                    </div>

                    <template v-if="$page.props.flash.message">
                        <Alert
                            :message="$page.props.flash.message"
                            type="success"
                        />
                    </template>

                    <div class="py-4">
                        <h2>Statistics</h2>
                        <DataTable :data="data" :total-items="data.length" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
