<template>
<nav class="col-md-12 col-sm-12 nav-top">
        <div class="row d-flex-between">
          <!-- Логотип и текст -->
          <div class="col-sm-12 col-12 col-md-12 col-lg-6 padding-0 d-flex-center">
            <a href="https://www.gov.kz/memleket/entities/karaganda">
              <img class="img-karaganda-logo" src="storage/images/Coat_of_Arms_of_Karagandy_Province.svg.png" alt="Логотип">
            </a>
            <h5 class="mb-0 header_and_footer_titles">Акимат Карагандинской области</h5>
          </div>
          <!-- Кнопки справа -->
          <div class="col-sm-12 col-12 col-md-12 col-lg-6 padding-0 calendar-wrappers">
            <div class="calendar-wrapper calendar-1 ">
                <svg id="reportrange" width="24" height="24" viewBox="0 0 24 24" style="cursor: pointer;" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_81_35)">
                    <path d="M17 3H21C21.2652 3 21.5196 3.10536 21.7071 3.29289C21.8946 3.48043 22 3.73478 22 4V20C22 20.2652 21.8946 20.5196 21.7071 20.7071C21.5196 20.8946 21.2652 21 21 21H3C2.73478 21 2.48043 20.8946 2.29289 20.7071C2.10536 20.5196 2 20.2652 2 20V4C2 3.73478 2.10536 3.48043 2.29289 3.29289C2.48043 3.10536 2.73478 3 3 3H7V1H9V3H15V1H17V3ZM20 9V5H17V7H15V5H9V7H7V5H4V9H20ZM20 11H4V19H20V11ZM6 13H11V17H6V13Z" fill="white"></path>
                  </g>
                  <defs>
                    <clipPath id="clip0_81_35">
                      <rect width="24" height="24" fill="white"></rect>
                    </clipPath>
                  </defs>
                </svg>
                  <date-range-picker
                          ref="picker"
                          :opens="'left'"
                          :dateRange="dateRange"
                          v-model="dateRange" 
                          @update:model-value = "onApply"
              />
            </div>
            <div class="calendar-wrapper calendar-2">
              <span class="calendar-clock">
                <span id="calendar-hour">{{ now }}</span>
              </span>
            </div>
            <div class="calendar-wrapper calendar-3">
              <a :href="route('dash-admin.index')">
                <svg width=" 24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_46_143)">
                    <path d="M3.34006 17C2.91733 16.269 2.58873 15.4875 2.36206 14.674C2.85537 14.4231 3.26965 14.0406 3.55909 13.5689C3.84852 13.0972 4.00183 12.5546 4.00203 12.0011C4.00224 11.4477 3.84934 10.905 3.56026 10.433C3.27118 9.96106 2.85718 9.57828 2.36406 9.32701C2.8161 7.69249 3.67679 6.19996 4.86506 4.99001C5.32915 5.29173 5.86768 5.45917 6.42104 5.47379C6.9744 5.48841 7.52101 5.34964 8.00039 5.07284C8.47977 4.79604 8.87321 4.392 9.13719 3.90545C9.40116 3.41889 9.52537 2.86878 9.49606 2.31601C11.1382 1.89163 12.8613 1.89232 14.5031 2.31801C14.474 2.87077 14.5985 3.4208 14.8626 3.90721C15.1268 4.39363 15.5204 4.79748 15.9999 5.07407C16.4794 5.35065 17.026 5.48919 17.5793 5.47436C18.1327 5.45952 18.6711 5.29189 19.1351 4.99001C19.7141 5.58001 20.2281 6.25101 20.6601 7.00001C21.0931 7.74901 21.4171 8.53001 21.6381 9.32601C21.1448 9.57691 20.7305 9.95938 20.441 10.4311C20.1516 10.9028 19.9983 11.4454 19.9981 11.9989C19.9979 12.5523 20.1508 13.0951 20.4399 13.567C20.7289 14.039 21.1429 14.4217 21.6361 14.673C21.184 16.3075 20.3233 17.8001 19.1351 19.01C18.671 18.7083 18.1324 18.5408 17.5791 18.5262C17.0257 18.5116 16.4791 18.6504 15.9997 18.9272C15.5204 19.204 15.1269 19.608 14.8629 20.0946C14.599 20.5811 14.4748 21.1312 14.5041 21.684C12.862 22.1084 11.1388 22.1077 9.49706 21.682C9.52611 21.1292 9.40166 20.5792 9.13748 20.0928C8.8733 19.6064 8.4797 19.2025 8.00023 18.9259C7.52076 18.6494 6.97412 18.5108 6.42079 18.5257C5.86746 18.5405 5.32902 18.7081 4.86506 19.01C4.27405 18.407 3.76166 17.7316 3.34006 17ZM9.00006 17.196C10.0657 17.8106 10.8669 18.797 11.2501 19.966C11.7491 20.013 12.2501 20.014 12.7491 19.967C13.1325 18.7979 13.9341 17.8114 15.0001 17.197C16.0653 16.5807 17.3206 16.3795 18.5251 16.632C18.8151 16.224 19.0651 15.789 19.2731 15.334C18.4525 14.4174 17.9992 13.2302 18.0001 12C18.0001 10.74 18.4701 9.56301 19.2731 8.66601C19.0636 8.21115 18.8125 7.77664 18.5231 7.36801C17.3193 7.62032 16.0649 7.41948 15.0001 6.80401C13.9344 6.18938 13.1332 5.20299 12.7501 4.03401C12.2511 3.98701 11.7501 3.98601 11.2511 4.03301C10.8677 5.20215 10.0661 6.18857 9.00006 6.80301C7.93484 7.41932 6.67954 7.62053 5.47506 7.36801C5.18563 7.77629 4.93519 8.21087 4.72706 8.66601C5.54763 9.58257 6.00094 10.7698 6.00006 12C6.00006 13.26 5.53006 14.437 4.72706 15.334C4.93653 15.7889 5.1876 16.2234 5.47706 16.632C6.68078 16.3797 7.93527 16.5805 9.00006 17.196ZM12.0001 15C11.2044 15 10.4413 14.6839 9.87874 14.1213C9.31613 13.5587 9.00006 12.7957 9.00006 12C9.00006 11.2044 9.31613 10.4413 9.87874 9.87869C10.4413 9.31608 11.2044 9.00001 12.0001 9.00001C12.7957 9.00001 13.5588 9.31608 14.1214 9.87869C14.684 10.4413 15.0001 11.2044 15.0001 12C15.0001 12.7957 14.684 13.5587 14.1214 14.1213C13.5588 14.6839 12.7957 15 12.0001 15ZM12.0001 13C12.2653 13 12.5196 12.8946 12.7072 12.7071C12.8947 12.5196 13.0001 12.2652 13.0001 12C13.0001 11.7348 12.8947 11.4804 12.7072 11.2929C12.5196 11.1054 12.2653 11 12.0001 11C11.7348 11 11.4805 11.1054 11.293 11.2929C11.1054 11.4804 11.0001 11.7348 11.0001 12C11.0001 12.2652 11.1054 12.5196 11.293 12.7071C11.4805 12.8946 11.7348 13 12.0001 13Z" fill="white"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_46_143">
                        <rect width="24" height="24" fill="white"></rect>
                    </clipPath>
                    </defs>
                </svg>
              </a>
            </div>
            <a href="https://imas.kz">
              <img class="img-imas-logo" src="storage/images/imas.png" alt="IMAS Logo">
            </a>
          </div>
        </div>
</nav>
</template>

<script>

import DateRangePicker from 'vue3-daterange-picker';
import { getCategoriesProblems } from '@/Use/api/main';
import { f_date,s_date } from '@/Use/data/items';
export default{
    name : 'TopNav',
    components: {DateRangePicker},
    data(){
      return{
          now : '',
          dateRange : {
                startDate: f_date,  // Получаем YYYY-MM-DD
                endDate: s_date,
            },
      }
    },

    setup(){return{f_date,s_date}},

    methods:{
      current_time(){
        const now = new Date();
        const time = now.toLocaleTimeString('ru',{
            hour: '2-digit',
            minute: '2-digit'
        })

        const day = now.toLocaleDateString('ru',{
          weekday: "short"
        })

        this.now = `${time}  ${day}.`
      },
     
      onApply(){
        const f_date = new Date(this.dateRange.startDate).toISOString().split('T')[0];
        const s_date = new Date(this.dateRange.endDate).toISOString().split('T')[0];
        getCategoriesProblems(f_date,s_date)
      }

      
    },

    mounted(){
      this.current_time();
      setInterval(this.current_time,6000)
    },

    watch: {
        f_date: {
            immediate: true, // чтобы сработало сразу при наличии
            handler(newVal) {
                this.dateRange.startDate = newVal;
            }
        },
        s_date: {
            immediate: true, // чтобы сработало сразу при наличии
            handler(newVal) {
              this.dateRange.endDate = newVal;
            }
        },
    }

    
    
}
</script>


