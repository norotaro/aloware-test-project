<script setup>
import CreateComment from '@/components/CreateComment.vue';
import { ref } from 'vue';

const props = defineProps(['comment']);
const replying = ref(false);
const emit = defineEmits(['created']);
</script>
<template>
    <div v-if="!replying" class="flex items-center mt-4 space-x-4">
        <button v-if="comment.level < 3" @click="replying = true" type="button"
            class="flex items-center text-sm text-gray-500 hover:underline">
            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                </path>
            </svg>
            Reply
        </button>
    </div>
    <CreateComment v-else :parent="comment" @created="replying = false; $emit('created');" @canceled="replying = false"
        class="mt-4">
    </CreateComment>
</template>