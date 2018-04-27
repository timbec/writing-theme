<template lang="html">
   <article class="article">
      {{ post.content.rendred }}
      <h1>{{ post.title.rendered }}</h1>
      <p v-html="post.content.rendered"></p>
   </article>

</template>

<script>
import Axios from 'axios';
export default {
   data: function() {
      return {
         posts: [],
         post: {
            title: {
               rendered: ''
            },
            content: {
               rendered: ''
            }
         },
         siteURL: writingportfolio_vars.site_url
      }
   },
   mounted: function() {
         var self = this;
         // Need to make this relative, not hard-coded
         Axios.get( 'http://writing-site.test/wp-json/wp/v2/posts?slug=' + this.$route.params.slug)
         .then( function(response) {
            self.post = response.data[0];
         })
         .catch( error => {
            alert('There was an error in your request');
            console.error( error.response.data.message );
         });
   }
}
</script>

<style lang="css">
</style>
