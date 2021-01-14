require('./bootstrap');

window.Vue = require('vue').default;
window.events = new Vue();

window.flash = function (message) {
    window.events.$emit('flash', {message});
}

Vue.component('flash', require('./components/Flash').default)
Vue.component('create-event', require('./components/CreateEvent.vue').default);
Vue.component('events', require('./components/Events.vue').default);


const app = new Vue({
    el: '#app',
});

