<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const comments = ref([]);
const user = ref('')
const message = ref('')

function getComments() {
  axios.get('api/comments')
    .then(({ data }) => {
      comments.value = data.data;
    })
    .catch(err => console.error(err))
}

function createComment() {
  axios.post('api/comments', {
    'user': user.value,
    'message': message.value
  })
    .then(() => {
      user.value = '';
      message.value = '';
      getComments()
    })
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

            <template v-for="comment in comments">
              <comment :comment="comment" @modified="getComments()"></comment>
            </template>
          </div>
        </section>
      </article>
    </div>
  </main>
</template>