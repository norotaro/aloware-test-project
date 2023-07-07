<script setup>
import ShowComment from '@/components/ShowComment.vue';
import ReplyComment from '@/components/ReplyComment.vue';
import EditComment from '@/components/EditComment.vue';
import DeleteComment from '@/components/DeleteComment.vue';
import { computed, ref } from 'vue';

const props = defineProps(['comment']);
const editing = ref(false);
const emit = defineEmits(['modified']);

function getClass(comment) {
  return {
    'bg-slate-200': comment.level == 1,
    'bg-slate-100': comment.level == 2,
    'ml-4': comment.level == 2,
    'bg-slate-50': comment.level == 3,
    'ml-8': comment.level == 3,
  };
}
</script>
<template>
  <article class="p-6 mb-4 text-base rounded-lg" :class="getClass(comment)">
    <div class="flex justify-between items-center mb-2">
      <div class="flex items-center">
        <p class="inline-flex items-center mr-3 text-sm text-gray-900">
          <img src="http://placeholder.co/40" alt="user image" class="mr-2 w-6 h-6 rounded-full">
          {{ comment.user }}
        </p>
        <p class="text-sm text-gray-600">
          <time datetime="2023-07-06">{{ (new Date(comment.date)).toDateString() }}</time>
          <span v-if="comment.edited" class="text-xs"> (edited)</span>
        </p>
      </div>
      <div v-if="!editing" class="flex">
        <button @click="editing = true"
          class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
          type="button">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
          </svg>

        </button>
        <DeleteComment @deleted="$emit('modified')" :comment="comment"></DeleteComment>
      </div>
    </div>

    <template v-if="!editing">
      <p class="text-gray-500">
        {{ comment.message }}
      </p>
      <ReplyComment :comment="comment" @created="$emit('modified')"></ReplyComment>
    </template>
    <EditComment v-else :comment="comment" @modified="$emit('modified'); editing = false;" @canceled="editing = false">
    </EditComment>
  </article>

  <ShowComment v-for="child in comment.comments" :comment="child" @modified="$emit('modified')"></ShowComment>
</template>