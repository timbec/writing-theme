<template>
  <button class="goTop" v-if="isVisible" @click="backToTop">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </button>
</template>

<script>
import jQuery from 'jquery';
export default {
    data() {
        return {
            isVisible: false
        }
    },
   methods: {
    initToTopButton: function() {
      jQuery(document).bind('scroll', function() {
        var backToTopButton = jQuery('.goTop');
        if (jQuery(document).scrollTop() > 250) {
          backToTopButton.addClass('isVisible');
          this.isVisible = true;
        } else {
          backToTopButton.removeClass('isVisible');
          this.isVisible = false;
        }
      }.bind(this));
    },
    backToTop: function() {
      jQuery('html,body').stop().animate({
        scrollTop: 0
      }, 'slow', 'swing');
    }
  },
  mounted: function() {
    this.$nextTick(function() {
      this.initToTopButton();
    });
  }
}
</script>

<style scoped>
    .goTop {
        border-radius: 5px;
        background-color: #09021d;
        position: fixed;
        width: 45px;
        height: 45px;
        display: block;
        right: 15px;
        bottom: 15px;
        border: none;
        opacity: 0;
        z-index: -1;
    }

    .fa {
        color: white;
        font-size:30px;
    }
    .goTop:hover {
        opacity: 1;
        background-color: #fff;
        border: 2px solid #09021d;
    }
    .goTop:hover > .fa {
       color: #09021d;
    }


    .isVisible {
    opacity: .8;
    z-index: 4;
    transition: all .4s ease-in;
    }
</style>
