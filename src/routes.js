import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Fiction from './pages/Fiction.vue';
import NonFiction from './pages/NonFiction.vue';
import Photography from './pages/Photography.vue';
import Posts from './posts/Posts.vue';
import Post from './posts/Post.vue';

export const routes = [
   {  path: '/', component: Home },
   {  path: '/about', component: About },
   {  path: '/fiction', component: Fiction },
   {  path: '/non-fiction', component: NonFiction },
   {  path: '/photography', component: Photography },
   { path: '/posts', component: Posts },
   { path: '/:slug', component: Post }
];
