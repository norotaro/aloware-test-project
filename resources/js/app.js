import { createApp } from "vue/dist/vue.esm-bundler";
import "./bootstrap";
import Home from "./components/Home.vue";

const app = createApp({});

app.component("home", Home);

app.mount("#app");
