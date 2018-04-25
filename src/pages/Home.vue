<template lang="html">
   <section>
      <h1>Home Page</h1>
      <article v-for="feature in features">

         <figure v-if="feature.thumbnail.length">
            <img :src="feature.thumbnail[0]" :alt="feature.title">
         </figure>

         <h3>
            <router-link :to="feature.link">
               {{ feature.title }}
            </router-link>
         </h3>
         <p>{{ feature.excerpt }}</p>

      </article>

   </section>
</template>

<script>
import Axios from 'axios';
export default {
   data() {
      return {
         features: [],
         feature: {
            title: {
               rendered: ''
            },
            link: ''
         },

         siteURL: writingportfolio_vars.site_url
      }
   },
   computed: {
      restEndPoint() {
         return `${this.siteURL}/wp-json/writing/v1/featured`;
      }
   },
   mounted() {
      this.getPosts();
   },
   methods: {
      getPosts: function() {
         Axios.get( this.restEndPoint )
         .then( response => this.features = response.data)
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
