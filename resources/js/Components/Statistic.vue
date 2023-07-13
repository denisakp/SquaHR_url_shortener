<script setup>
defineProps(["unique_visitors", "total", "most_clicked"]);
</script>

<template>
    <div class="grid gap-6 mb-6 md:grid-cols-2 xl:grid-cols-3">
        <div class="min-w-0 rounded-lg shadow-xs overflow-hidden">
            <div class="p-4 flex items-center border border-black">
                <div>
                    <p
                        class="mb-2 text-sm font-medium text-gray-600"
                    >
                        Unique Visitors
                    </p>
                    <p
                        class="text-lg font-semibold text-gray-700"
                    >
                        {{ unique_visitors }}
                    </p>
                </div>
            </div>
        </div>

        <div
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white"
        >
            <div class="p-4 flex items-center border border-black">
                <div>
                    <p
                        class="mb-2 text-sm font-medium text-gray-600"
                    >
                        Count Link
                    </p>
                    <p
                        class="text-lg font-semibold text-gray-700"
                    >
                        {{ total }}
                    </p>
                </div>
            </div>
        </div>

        <div
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white"
        >
            <div class="p-4 flex items-center border border-black">
                <div>
                    <p
                        class="mb-2 text-sm font-medium text-gray-600"
                    >
                        Most clicked link
                    </p>
                    <p>
                        <template v-if="most_clicked"> <span class="text-lg font-semibold text-blue-700"></span> {{ most_clicked }}</template>
                        <template v-else> NONE </template>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
