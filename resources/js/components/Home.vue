<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const comments = ref([]);

onMounted(() => {
  axios.get('api/comments')
    .then(({ data }) => {
      comments.value = data.data;
    })
    .catch(err => console.error(err))
})
</script>

<template>
  <main class="pt-8 pb-16">
    <div class="flex justify-between px-4 mx-auto">
      <article class="mx-auto w-full max-w-2xl">
        <post></post>

        <section class="py-8">
          <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-lg font-bold text-gray-900">Discussion</h2>
            </div>

            <article v-for="comment in comments" class="p-6 mb-4 text-base rounded-lg">
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
              </div>

              <p class="text-gray-500">
                {{ comment.message }}
              </p>
            </article>
          </div>
        </section>
      </article>
    </div>
  </main>
</template>