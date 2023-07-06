<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const comments = ref([]);

function getComments() {
  axios.get('api/comments')
    .then(({ data }) => {
      comments.value = data.data;
    })
    .catch(err => console.error(err))
}

onMounted(() => {
  getComments();
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

            <create-comment @created="getComments"></create-comment>

            <template v-for="comment in comments">
              <comment :comment="comment" @modified="getComments"></comment>
            </template>
          </div>
        </section>
      </article>
    </div>
  </main>
</template>