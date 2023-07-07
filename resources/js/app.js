import "./bootstrap";
import "../css/app.css";

import { createApp } from "vue/dist/vue.esm-bundler";
import Home from "./components/Home.vue";
import Post from "./components/Post.vue";
import Comment from "./components/Comment.vue";
import CreateComment from "./components/CreateComment.vue";
import EditComment from "./components/EditComment.vue";
import DeleteComment from "./components/DeleteComment.vue";

const app = createApp({});

app.component("home", Home);
app.component("post", Post);
app.component("comment", Comment);
app.component("create-comment", CreateComment);
app.component("edit-comment", EditComment);
app.component("delete-comment", DeleteComment);

app.mount("#app");
