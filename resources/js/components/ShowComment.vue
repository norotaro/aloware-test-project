<script setup>
import ShowComment from '@/components/ShowComment.vue';
import CreateComment from '@/components/CreateComment.vue';
import EditComment from '@/components/EditComment.vue';
import DeleteComment from '@/components/DeleteComment.vue';
import { ref } from 'vue';

const props = defineProps(['comment']);
const editing = ref(false);
const replying = ref(false);
const emit = defineEmits(['modified']);
</script>
<template>
  <article class="p-6 mb-4 text-base"
    :class="{ 'border-t': comment.level == 1, 'ml-6': comment.level == 2, 'ml-12': comment.level == 3 }">
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
      <div v-if="!editing" class="flex">
        <button @click="editing = true"
          class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
          type="button">
          <span>Edit</span>
        </button>
        <DeleteComment @deleted="$emit('modified')" :comment="comment"></DeleteComment>
      </div>
    </div>

    <template v-if="!editing">
      <p class="text-gray-500">
        {{ comment.message }}
      </p>
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
      <CreateComment v-else :parent="comment" @created="replying = false; $emit('modified');" @canceled="replying = false"
        class="mt-4">
      </CreateComment>
    </template>
    <EditComment v-else :comment="comment" @modified="$emit('modified'); editing = false;" @canceled="editing = false">
    </EditComment>
  </article>

  <ShowComment v-for="child in comment.comments" :comment="child" @modified="$emit('modified')"></ShowComment>
</template>