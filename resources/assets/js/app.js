
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
<<<<<<< HEAD
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
=======
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
>>>>>>> eb0684fbe0c9c20bdf7f04e773174caa16e1e811
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
