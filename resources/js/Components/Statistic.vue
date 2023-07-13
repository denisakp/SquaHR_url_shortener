<script setup>
defineProps(['unique_visitors', 'total', 'most_clicked'])
</script>

<template>
    <!-- component -->
    <div class="grid gap-6 mb-6 md:grid-cols-2 xl:grid-cols-3">
        <div
            class="min-w-0 rounded-lg shadow-xs overflow-hidden"
        >
            <div class="p-4 flex items-center border border-black">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Unique Visitors
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ unique_visitors }}
                    </p>
                </div>
            </div>
        </div>

        <div
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
        >
            <div class="p-4 flex items-center border border-black">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Count Link
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ total }}
                    </p>
                </div>
            </div>
        </div>

        <div
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
        >
            <div class="p-4 flex items-center border border-black">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Most clicked link
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{  most_clicked }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</template>
