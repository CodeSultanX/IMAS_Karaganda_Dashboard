<template>
    <div class="list-items cart-wrapper">
        <div class="list-left ">
            <h1 class="cart-title">Количество очагов:</h1>
            <ul>
                <li v-for="(params,level) in leftCategories" :key="level" :class="['block level',{ active : activeLevel === level}]">
                    <a @click.prevent="getListsProblem(level,f_date,s_date)">
                        <h3 class="outbreaks-title">{{ titleCategory(level,params.total) }} </h3>
                        <span v-if="params.count.summ > 0"> Очагов: {{ params.count.summ }} &nbsp; </span>
                        <span v-if="params.count.danger > 0 || params.count.yellow > 0 || params.count.warning > 0" class="outbreaks-count-block">
                            <span v-if="params.count.danger > 0" class="red_text">{{ params.count.danger }} ,</span> 
                            <span v-if="params.count.yellow > 0" class="yellow_text">{{ params.count.yellow }} , </span> 
                            <span v-if="params.count.warning > 0"  class="orange_text">{{ params.count.warning }} </span> 
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="list-right">
            <h1 class="cart-title">Проблемные вопросы:</h1>
            <ul>
                <li v-for="(params,level) in rightCategories" :key="level" :class="['block problem-block',{ active : activeLevel === level}]">
                    <a @click.prevent="getListsProblem(level,f_date,s_date)" class="d-flex-center">
                        <div class="list-right-count"> {{ params.total }} </div>
                        <div class="problem-title">{{ titleCategory(level,params.total) }}</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
    
<script>

import { f_date, s_date } from '@/Use/data/items';
import {getLevelsWidthProblemsList} from '@/Use/api/main';
export default{
    name : 'Category',

    props:{
        'counts_problem' : {
            type : Object
        }
    },
    data() {
        return {
            leftCategories : {},
            rightCategories : {},
            activeLevel : 'all',
        }
    },
    setup(){return {f_date,s_date}},

    methods: {
        titleCategory(level,total){
            if(level == 'all') return `Всего ${total} проблемных вопроса`;
            if(level == 'republic') return `Республиканский уровень`;
            if(level == 'obl') return `Облостной уровень`;
            if(level == 'city') return `Городской уровень`;
            if(level == '1') return `Системообразующие предприятия`;
            if(level == '2') return `Проблемные ЖК (дольщики)`;
            if(level == '3') return `Проблемы в сфере ЖКХ и автодорог`;
            if(level == '4') return ` Другие социальные проблемы `;
            if(level == '5') return `Экологические проблемы`;
            if(level == '6') return `Проблемы в сельскохозяйственном направлении`;
        },

        getListsProblem(level,f_date,s_date){
            this.activeLevel = level;
            getLevelsWidthProblemsList(level,f_date,s_date);
        }
            
    },


    watch: {
        counts_problem: {
            immediate: true, // чтобы сработало сразу при наличии
            deep: true,
            handler(newVal) {
                if (newVal && Object.keys(newVal).length > 0) {
                    this.leftCategories = Object.fromEntries(
                    Object.entries(newVal).filter(([key]) =>
                        ['all', 'city', 'republic', 'obl'].includes(key)
                    ));
                    this.rightCategories = Object.fromEntries(
                    Object.entries(newVal).filter(([key]) =>
                        ['1', '2', '3', '4', '5', '6'].includes(key)
                    ));
                }
            }
        }
    }
   
}
</script>