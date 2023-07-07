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
            <span>Delete</span>
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