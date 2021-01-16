import Vue from "vue";
window.Vue = Vue;
require("./bootstrap");
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
const app = new Vue({
    el: "#app",
});
