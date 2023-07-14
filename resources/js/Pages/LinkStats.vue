<script setup>
import { Head } from "@inertiajs/vue3";
import {
    Pagination,
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeadCell,
    TableRow,
} from "flowbite-vue";
import { computed, ref } from "vue";

const props = defineProps(["link", "stats", "unique_view", "rank"]);

const tableHeaders = ref(["Viewed At", "IP Address"]);

const currentPage = ref(1);
const perPage = ref(2);

const displayedRows = computed(() => {
    if (!props.stats) return [];

    const startIndex = (currentPage.value - 1) * perPage.value;
    const endIndex = startIndex + perPage.value;

    return props.stats.slice(startIndex, endIndex);
});

const dateOptions = { dateStyle: "full", timeStyle: "long" };
</script>

<template>
    <div>
        <Head :title="link.code + 'stats'" />

        <div class="flex h-screen overflow-hidden">
            <div
                class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden"
            >
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <h1
                            class="text-3xl font-bold tracking-tight text-gray-900"
                        >
                            Shortened URL {{ link.code }} stats
                        </h1>
                    </div>
                </header>

                <div class="mx-auto container max-w-7xl py-3 sm:px-6 lg:px-8">
                    <h2>Statistics</h2>
                    <div class="py-3">
                        <div
                            class="grid gap-6 mb-6 md:grid-cols-2 xl:grid-cols-3"
                        >
                            <div
                                class="min-w-0 rounded-lg shadow-xs overflow-hidden"
                            >
                                <div
                                    class="p-4 flex items-center border border-black"
                                >
                                    <div>
                                        <p
                                            class="mb-2 text-sm font-medium text-gray-600"
                                        >
                                            Total Views
                                        </p>
                                        <p
                                            class="text-lg font-semibold text-gray-700"
                                        >
                                            {{ stats.length }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white"
                            >
                                <div
                                    class="p-4 flex items-center border border-black"
                                >
                                    <div>
                                        <p
                                            class="mb-2 text-sm font-medium text-gray-600"
                                        >
                                            Unique clicks
                                        </p>
                                        <p
                                            class="text-lg font-semibold text-gray-700"
                                        >
                                            {{ unique_view }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white"
                            >
                                <div
                                    class="p-4 flex items-center border border-black"
                                >
                                    <div>
                                        <p
                                            class="mb-2 text-sm font-medium text-gray-600"
                                        >
                                            Rank
                                        </p>
                                        <p class="text-lg font-semibold">
                                            {{ rank }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-auto container max-w-7xl py-3 sm:px-6 lg:px-8">
                    <div class="space-y-12 p-4">
                        <Table
                            class="table-auto border border-gray-700 border-collapse"
                            striped
                        >
                            <table-head class="text-black">
                                <table-head-cell class="border border-slate-300"
                                    >#ID</table-head-cell
                                >
                                <template
                                    v-for="(header, index) in tableHeaders"
                                    :key="index"
                                >
                                    <table-head-cell
                                        class="text-left border border-slate-300"
                                        >{{ header }}</table-head-cell
                                    >
                                </template>
                            </table-head>

                            <table-body>
                                <template
                                    v-for="(link, _index) in displayedRows"
                                    :key="_index"
                                >
                                    <table-row>
                                        <table-cell
                                            class="px-6 py-3 border border-slate-300"
                                            >{{ link.id }}</table-cell
                                        >

                                        <table-cell
                                            class="border border-slate-300"
                                        >
                                            <p class="font-medium">
                                                {{
                                                    new Date(
                                                        link.created_at,
                                                    ).toLocaleString(
                                                        "fr-FR",
                                                        dateOptions,
                                                    )
                                                }}
                                            </p>
                                        </table-cell>

                                        <table-cell
                                            class="border border-slate-300"
                                        >
                                            <p>{{ link.visitor }}</p>
                                        </table-cell>
                                    </table-row>
                                </template>
                            </table-body>
                        </Table>

                        <div
                            class="p-6 flex items-center justify-center text-center"
                        >
                            <pagination
                                v-model="currentPage"
                                :per-page="perPage"
                                :total-items="stats.length"
                                :layout="'table'"
                                show-icons
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
