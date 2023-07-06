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
        <header class="mb-4">
          <div class="flex items-center mb-4">
            <div class="inline-flex items-center text-sm mr-3">
              <img class="rounded-full w-16 h-16 mr-4" src="https://placeholder.co/50?text=avatar" alt="User">
              <div>
                <a href="#" class="text-xl font-bold text-gray-900">Nelson Otazo</a>
                <p class="text-base font-light text-gray-500">Full-Stack developer</p>
                <p class="text-base font-light text-gray-500">
                  <time datetime="2023-07-06">July 6, 2023</time>
                </p>
              </div>
            </div>
          </div>

          <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900">
            Aloware test project
          </h1>
        </header>

        <div>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi quo voluptatum incidunt aperiam sequi
            quidem obcaecati vitae veniam corporis perferendis, debitis itaque omnis porro sapiente molestias aliquam et
            voluptates. Praesentium?</p>
          <figure>
            <img class="p-5" src="https://placeholder.co/300?text=Blog+image" alt="blog image">
          </figure>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus amet doloremque aut. Esse at repellendus,
            deserunt quam eligendi sequi distinctio optio autem. Nisi corporis voluptates, libero quas rem vel a.
          </p>
        </div>

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