<script setup>
import {
    Pagination,
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeadCell,
    TableRow,
} from "flowbite-vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
    data: {
        type: Object,
        default: {},
    },
    perPage: {
        type: Number,
        default: 15,
    },
    totalItems: {
        type: Number,
        default: 1,
    },
});

const page = usePage();

const currentPage = ref(1);
const tableHeaders = ref(["Long URL", "Shorted Code", "Views counter"]);

const displayedRows = computed(() => {
    if (!props.data) return [];

    const startIndex = (currentPage.value - 1) * props.perPage;
    const endIndex = startIndex + props.perPage;

    return props.data.slice(startIndex, endIndex);
});

const reload = (link, shorted) => {
    router.get(`/${shorted}`)
    window.open(link);

};
</script>

<template>
    <div class="p-4 container">
        <template v-if="data">
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
                    <table-head-cell
                        ><span class="sr-only border border-slate-300"
                            >Edit</span
                        ></table-head-cell
                    >
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

                            <table-cell class="border border-slate-300">
                                <a
                                    class="font-medium text-blue-600 hover:underline"
                                    target="_blank"
                                    :href="link.url"
                                >
                                    {{ link.url.substring(0, 50) + "..." }}
                                </a>
                            </table-cell>

                            <table-cell class="border border-slate-300">
                                <Link
                                    class="font-medium text-blue-600 hover:underline"
                                    :href="link.url"
                                    @click="reload(link.url, link.code)"
                                >
                                    {{ link.code }}
                                </Link>
                            </table-cell>

                            <table-cell
                                class="px-6 py-3 border border-slate-300"
                                >{{ link.statistics_count }}</table-cell
                            >
                            <table-cell class="border border-slate-300">
                                <Link
                                    class="font-medium text-yellow-400 hover:underline"
                                    :href="`/${link.id}/stats`"
                                >
                                    View Stats
                                </Link>
                            </table-cell>
                        </table-row>
                    </template>
                </table-body>
            </Table>

            <div class="p-6 flex items-center justify-center text-center">
                <pagination
                    v-model="currentPage"
                    :per-page="perPage"
                    :total-items="totalItems"
                    :layout="'table'"
                    show-icons
                />
            </div>
        </template>

        <template v-else>
            <Table>
                <table-head>
                    <table-head-cell>ID</table-head-cell>
                    <template
                        v-for="(header, index) in tableHeaders"
                        :key="index"
                    >
                        <table-head-cell>{{ header }}</table-head-cell>
                    </template>
                </table-head>
                No data
            </Table>
        </template>
    </div>
</template>
