<template>
  <div class="col-md-12 col-sm-12 col-lg-12 col-12 cart-wrapper footer_dashboard">
        <div class="news-block">
          <div class="header_and_footer_titles live">LIVE:</div>
          <div class="news-types-block">
            <div class="smi">СМИ</div>
            <div class="social">СОЦСЕТИ</div>
          </div>
          <div class="news-content">
            <div class="news-smi">
              <marquee> 
                <span v-for="news in news_smi" >
                  {{ news }};
                </span>
              </marquee>
            </div>
            <div class="news-social">
              <marquee > 
                <span v-for="news in news_social" >
                  {{ news }};
                </span>
              </marquee>
            </div>
          </div>
        </div>
   </div>
</template>
    
<script>

import { projectData } from '@/Use/data/items';
export default{
    name : 'Footer',
    setup(){return{projectData}},
    
    data(){
      return {
          news_smi : {},    
          news_social : {},
      }
    },

    watch:{
      projectData : {
            immediate: true,
            deep:true,
            handler(newVal){
              projectData.value.forEach(element => {
                  this.news_smi = element.news.smi;
                  this.news_social = element.news.social;
              });
             
           
            }
        }
    }
}
</script>






