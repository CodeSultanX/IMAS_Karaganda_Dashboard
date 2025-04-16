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

import 'bootstrap/dist/css/bootstrap.min.css'
import { Head } from '@inertiajs/vue3';
import TopNav from '@/Components/Main/TopNav.vue';
import Footer from '@/Components/Main/Footer.vue';
import {getCategoriesProblems,getLevelsWidthProblemsList} from '@/Use/api/main';
import { problems,f_date,s_date } from '@/Use/data/items';
import { watch } from 'vue';
import { ref } from 'vue';

const data = ref([])
getCategoriesProblems();


watch(
  () => problems.value.all,
  (newVal) => {
    if(newVal.list.length > 0){
      data.value = newVal.list;
      const dates = Object.values(data.value).map(obj => new Date(obj.created_at));
      f_date.value = new Date(Math.min(...dates)).toISOString().split('T')[0];
      s_date.value = new Date(Math.max(...dates)).toISOString().split('T')[0];
      getLevelsWidthProblemsList('all',f_date.value,s_date.value)
    }
  }
)

</script>