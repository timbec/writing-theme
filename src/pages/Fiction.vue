<template lang="html">
   <section id="-page" class="container">
      <h1>Fiction Page</h1>
      <article v-for="post in posts">

         <figure v-if="post.thumbnail.length">
            <img :src="post.thumbnail[0]" :alt="post.title">
         </figure>

         <h3>
            <router-link :to="'/' + post.link">
               {{ post.title }}
            </router-link>
         </h3>
         <p>{{ post.excerpt }}</p>

      </article>

   </section>
</template>

<script>
import Axios from 'axios';
export default {
   data() {
      return {
         posts: [],
         post: {
            title: '',
            excerpt: {
               rendered: ''
            },
            link: ''
         },
         siteURL: writingportfolio_vars.site_url
      }
   },
   computed: {
      restEndPoint() {
         return `${this.siteURL}/wp-json/writing/v1/fiction`;
      }
   },
   mounted() {
      this.getFictionPosts();
   },
   methods: {
      getFictionPosts: function() {
         Axios.get( this.restEndPoint )
         .then(response => this.posts = response.data)
         .catch( error => {
            alert('There was an error in your request');
            console.error( error.response.data.message );
         });
      }
   }
}
</script>

<style lang="css">
</style>
