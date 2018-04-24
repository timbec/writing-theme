import Posts from './posts/Posts.vue';
import Post from './posts/Post.vue';

export const routes = [
   { path: '/', component: Posts },
   { path: '/:slug', component: Post }
];
