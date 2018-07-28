<template lang="html">
   <!-- TODO: need to bring these from top level categories (child categories can be sub-menu on page) -->
  <nav>
     <ul>
        <li v-for="page in pages">
           <router-link :to="'/' + page.link">{{ page.title }}</router-link>
        </li>
     </ul>
  </nav>
</template>
<!-- Think either top level pages or importing the actual menu would be better here (from spa_final):
function spa_menus_get_all_menus(){
	$menus                      =   [];

	foreach( get_registered_nav_menus() as $slug => $desc ){
		$obj                    =   new stdClass;
		$obj->slug              =   $slug;
		$obj->description       =   $desc;
		$menus[]                =   $obj;
	}

	return $menus;
}
 -->
<script>
import Axios from 'axios';
console.log(Axios);
export default {
   data() {
      return {
         pages: '',
         page: {
            title: ''
         },
         siteURL: writingportfolio_vars.site_url
      }
   },
   computed: {
      restEndPoint() {
         return `${this.siteURL}/wp-json/writing/v1/pages`;
      }
   },
   mounted() {
      this.getPages();
   },
   methods: {
      getPages: function() {
         console.log(this.restEndPoint);
         Axios.get( this.restEndPoint )
         .then( response => this.pages = response.data )
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
