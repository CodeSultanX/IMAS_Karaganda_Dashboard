<template>
     <div class="cart-wrapper list-problems">
        <div class="cart-title"> Список очагов</div>
        <h2 class="list-problems-title">{{problemsTitle(level,total,outbreaks)}}</h2>
        <ul class="problems-list" id="content">
            <li v-for="problem in problemsList.data" :class="`${colorEl(problem.color)} problem-item`" data-toggle="modal" data-target="#myModal1">
                <b>{{ problem.title }}</b>
                <div class="agile-detail">
                    <p>{{ problem.status }}</p>
                </div>
            </li>
           
        </ul>
    </div>
</template>
    
<script>
import { problemsList } from '@/Use/data/items';
export default{
    name : 'ProblemList',

    data(){
        return{
            level : '',
            total : '',
            outbreaks : '',
        }
    },
    setup(){return{problemsList}},

    methods: {
        colorEl(color){
            if(color == 'warning') return 'warning-el'
            if(color == 'danger') return 'danger-el'
            if(color == 'yellow') return 'yellow-el'
        },
       
        problemsTitle(level,total,outbreaks){
            if(level == 'all') return `Всего ${total} проблемных вопроса. Очагов: ${outbreaks}`;
            if(level == 'republic') return `Республиканский уровень -${total}. Очагов: ${outbreaks}`;
            if(level == 'obl') return `Облостной уровень - ${total}. Очагов: ${outbreaks}`;
            if(level == 'city') return `Городской уровень - ${total}. Очагов: ${outbreaks}`;
            if(level == '1') return `Системообразующие предприятия - ${total}.`;
            if(level == '2') return `Проблемные ЖК (дольщики) - ${total}.`;
            if(level == '3') return `Проблемы в сфере ЖКХ и автодорог - ${total}.`;
            if(level == '4') return ` Другие социальные проблемы - ${total}. `;
            if(level == '5') return `Экологические проблемы - ${total}.`;
            if(level == '6') return `Проблемы в сельскохозяйственном направлении - ${total}.`;
        },
        
    },


    watch:{
        problemsList : {
            immediate: true,
            handler(newVal){
                this.total = newVal.total;
                this.outbreaks = newVal.outbreaks;
                this.level = newVal.level;
            }
        }
    }



}
</script>