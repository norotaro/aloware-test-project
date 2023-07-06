import "./bootstrap";
import "../css/app.css";

import { createApp } from "vue/dist/vue.esm-bundler";
import Home from "./components/Home.vue";
import Post from "./components/Post.vue";
import Comment from "./components/Comment.vue";

const app = createApp({});

app.component("home", Home);
app.component("post", Post);
app.component("comment", Comment);

app.mount("#app");
