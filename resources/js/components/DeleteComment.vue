<script setup>
import { ref } from 'vue';

const props = defineProps(['comment']);
const emit = defineEmits(['deleted']);
const showModal = ref(false);

function deleteComment(id) {
    axios.delete(`api/comments/${id}`)
        .then(() => {
            emit('deleted');
            showModal.value = false;
        })
        .catch(err => console.error(err))
}
</script>
<template>
    <div>
        <!-- Modal toggle -->
        <button @click="showModal = true"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>

        </button>

        <!-- Main modal -->
        <div v-if="showModal"
            class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                <div class="w-full">
                    <div class="m-8 my-20 max-w-[400px] mx-auto">
                        <div class="mb-8">
                            <h1 class="mb-4 text-3xl font-extrabold">
                                Delete confirmation
                            </h1>
                            <p class="text-gray-600">
                                Are you sure you want to delete this comment?
                            </p>
                        </div>
                        <div class="space-y-4">
                            <button @click="deleteComment(comment.id)"
                                class="p-3 bg-red-500 rounded-full text-white w-full font-semibold">
                                Yes, delete
                            </button>
                            <button @click="showModal = false"
                                class="p-3 bg-white border rounded-full w-full font-semibold">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>