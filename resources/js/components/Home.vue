<script setup>
import Post from '@/components/Post.vue';
import ShowComment from '@/components/ShowComment.vue';
import CreateComment from '@/components/CreateComment.vue';
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
        <Post></Post>

        <section class="py-8">
          <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-lg font-bold text-gray-900">Discussion</h2>
            </div>

            <CreateComment @created="getComments" class="mb-4"></CreateComment>

            <template v-for="comment in comments">
              <ShowComment :comment="comment" @modified="getComments"></ShowComment>
            </template>
          </div>
        </section>
      </article>
    </div>
  </main>
</template>