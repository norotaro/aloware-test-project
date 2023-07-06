<script setup>
import { ref } from 'vue';

const props = defineProps(['comment']);
const edditing = ref(false);
const emit = defineEmits(['edited'])


function editComment(comment) {
  axios.put(`api/comments/${comment.id}`, {
    'message': comment.message
  })
    .then(() => {
      edditing.value = false;
      emit('edited');
    })
    .catch(err => console.error(err))
}

function deleteComment(id) {
  axios.delete(`api/comments/${id}`)
    .then(() => {
      getComments();
    })
    .catch(err => console.error(err))
}
</script>
<template>
  <article class="p-6 mb-4 text-base rounded-lg">
    <div class="flex justify-between items-center mb-2">
      <div class="flex items-center">
        <p class="inline-flex items-center mr-3 text-sm text-gray-900">
          <img src="http://placeholder.co/40" alt="user image" class="mr-2 w-6 h-6 rounded-full">
          {{ comment.user }}
        </p>
        <p class="text-sm text-gray-600">
          <time datetime="2023-07-06">{{ (new Date(comment.created_at)).toDateString() }}</time>
        </p>
      </div>
      <div v-if="!edditing" class="flex">
        <button @click="edditing = true"
          class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
          type="button">
          <span>Edit</span>
        </button>
        <button @click="deleteComment(comment.id)"
          class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
          type="button">
          <span>Delete</span>
        </button>
      </div>
    </div>

    <p v-if="!edditing" class="text-gray-500">
      {{ comment.message }}
    </p>
    <form v-else @submit.prevent="editComment(comment)">
      <div class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-200">
        <label for="comment" class="sr-only">Your comment</label>
        <textarea id="comment" rows="5" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
          required v-model="comment.message"></textarea>
      </div>
      <button type="submit"
        class="inline-flex items-center mr-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-cyan-500 rounded-lg">
        Update comment
      </button>
      <button type="button" @click="edditing = false"
        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-cyan-500 rounded-lg">
        Cancel
      </button>
    </form>
  </article>
</template>