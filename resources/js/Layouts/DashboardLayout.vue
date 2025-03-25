<template>
     <Head title="Dashboard проблемных вопросов" />
     <div class="col-12">
      <TopNav />

      <div class="col-md-12 col-sm-12 col-lg-12 padding-0">
        <slot/>
        
      </div>

      <Footer />
    </div>  
</template>

<script setup>


import { Head } from '@inertiajs/vue3';
import TopNav from '@/Components/Main/TopNav.vue';
import Footer from '@/Components/Main/Footer.vue';
 

</script>