<script setup>
import { ref } from 'vue';

const user = ref('');
const message = ref('');
const emit = defineEmits(['created']);

function createComment() {
    axios.post('api/comments', {
        'user': user.value,
        'message': message.value
    })
        .then(() => {
            user.value = '';
            message.value = '';
            emit('created');
        })
}
</script>
<template>
    <form @submit.prevent="createComment">
        <div class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-200">
            <label for="user" class="sr-only">Your name</label>
            <input v-model="user" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                id="user" type="text" placeholder="Your name...">
        </div>
        <div class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-200">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea v-model="message" id="comment" rows="5"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-cyan-500 rounded-lg">
            Post comment
        </button>
    </form>
</template>