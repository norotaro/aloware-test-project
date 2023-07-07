<script setup>
const props = defineProps(['comment']);
const emit = defineEmits(['modified', 'canceled']);

function editComment(comment) {
    axios.put(`api/comments/${comment.id}`, {
        'message': comment.message
    })
        .then(() => {
            emit('modified');
        })
        .catch(err => console.error(err))
}
</script>
<template>
    <form @submit.prevent="editComment(comment)">
        <div class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-200">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" rows="5"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none" required
                v-model="comment.message"></textarea>
        </div>
        <button type="submit"
            class="inline-flex items-center mr-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-cyan-500 rounded-lg">
            Update comment
        </button>
        <button type="button" @click="$emit('canceled')"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-red-500 rounded-lg">
            Cancel
        </button>
    </form>
</template>