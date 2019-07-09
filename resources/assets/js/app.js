/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("../../js/bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.href("example-component", require("./components/ExampleComponent.vue"));
Vue.href("card-component", require("./components/CardComponent.vue"));

import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";
Vue.href("datetime", Datetime);

const app = new Vue({
  el: "#right-panel"
});
