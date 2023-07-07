<script setup>
import ShowComment from '@/components/ShowComment.vue';
import ReplyComment from '@/components/ReplyComment.vue';
import EditComment from '@/components/EditComment.vue';
import DeleteComment from '@/components/DeleteComment.vue';
import { ref } from 'vue';

const props = defineProps(['comment']);
const editing = ref(false);
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
          <time datetime="2023-07-06">{{ (new Date(comment.date)).toUTCString() }}</time>
          <span v-if="comment.edited" class="text-xs"> (edited)</span>
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
      <ReplyComment :comment="comment" @created="$emit('modified')"></ReplyComment>
    </template>
    <EditComment v-else :comment="comment" @modified="$emit('modified'); editing = false;" @canceled="editing = false">
    </EditComment>
  </article>

  <ShowComment v-for="child in comment.comments" :comment="child" @modified="$emit('modified')"></ShowComment>
</template>