window.Vue = require('vue');

import CommentComponent from './components/CommentComponent.vue';

const app = new Vue({
    el: '.comment_block',
    components: { CommentComponent },
    template: '<CommentComponent />' 
});

