import { createApp } from "vue/dist/vue.esm-bundler";
import Home from "./components/Home.vue";
import "./bootstrap";
import "../css/app.css";

const app = createApp({});

app.component("home", Home);

app.mount("#app");
