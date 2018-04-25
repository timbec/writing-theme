import Home from './pages/Home.vue';

import Posts from './posts/Posts.vue';
import Post from './posts/Post.vue';

export const routes = [
   {  path: '/', component: Home },
   { path: '/posts', component: Posts },
   { path: '/:slug', component: Post }
];
