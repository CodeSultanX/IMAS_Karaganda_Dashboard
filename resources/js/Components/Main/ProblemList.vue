<template>
     <div class="cart-wrapper list-problems">
        <div class="cart-title"> Список очагов</div>
        <h2 class="list-problems-title">{{problemsTitle(level,total,outbreaks)}}</h2>
        <ul class="problems-list" id="content">
            <li
                @click="openModal(problem)" 
                v-for="problem in problemsList.data" 
                :class="`${colorEl(problem.color)} problem-item`">
                <b>{{ problem.title }}</b>
                <div class="agile-detail">
                    <p>{{ problem.status }}</p>
                </div>
            </li>
           
        </ul>
    </div>

    <!-- <div
      class="modal fade show"
      tabindex="-1"
      role="dialog"
      v-if="selectedProblem"
      style="display: block; background: rgba(0, 0, 0, 0.5)"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Модальное окно: {{ selectedProblem.title }}</h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <p>{{ selectedProblem.status }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">
              Закрыть
            </button>
            <button type="button" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
      </div>
    </div> -->

    <div class="modal inmodal fade show" 
    tabindex="-1" 
    role="dialog" 
    style="display: block; padding-right: 15px;background: rgba(0, 0, 0, 0.5)" 
    v-if="selectedProblem"
    aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div :class="`modal-header ${selectedProblem.color}-el`"  >
                    <h4 class="modal-title">{{ selectedProblem.title }}</h4>
                </div>
                <div class="modal-body">
                    <p><strong>Уровень:</strong> {{ getProblemLevel(selectedProblem.level) }}</p>
                    <p><strong>Текущее состояние:</strong> {{ selectedProblem.status }}</p>
                    <p><strong>Принимаемые меры (результаты работы):</strong> {{ selectedProblem.result }}</p>
                    <p><strong>Ответственный:</strong> {{ selectedProblem.username }}</p>
                </div>
                <div class="modal-footer" style="border-top: 4px solid #1B1F22;">
                    <button type="button" class="btn btn-white" @click="closeModal">Закрыть</button>
                </div>
            </div>
        </div>
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
            selectedProblem: null,
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
            if(level == 'all')      return `Всего ${total} проблемных вопроса. Очагов: ${outbreaks}`;
            if(level == 'republic') return `Республиканский уровень -${total}. Очагов: ${outbreaks}`;
            if(level == 'obl')      return `Облостной уровень - ${total}. Очагов: ${outbreaks}`;
            if(level == 'city')     return `Городской уровень - ${total}. Очагов: ${outbreaks}`;
            if(level == '1')        return `Системообразующие предприятия - ${total}.`;
            if(level == '2')        return `Проблемные ЖК (дольщики) - ${total}.`;
            if(level == '3')        return `Проблемы в сфере ЖКХ и автодорог - ${total}.`;
            if(level == '4')        return ` Другие социальные проблемы - ${total}. `;
            if(level == '5')        return `Экологические проблемы - ${total}.`;
            if(level == '6')        return `Проблемы в сельскохозяйственном направлении - ${total}.`;
        },
        openModal(problem){
            this.selectedProblem = problem;
        },
        closeModal() {
            this.selectedProblem = null;
        },

        getProblemLevel(level){
            const levels = {
                 "republic" : "Республиканский уровень",
                 "obl" : "Областной уровень",
                 "city" : "Городской уровень",
                 "1" : "Системообразующие предприятия",
                 "2" : "Проблемные ЖК (дольщики)",
                 "3" : "Проблемы в сфере ЖКХ и автодорог",
                 "4" : "Другие социальные проблемы",
                 "5" : "Экологические проблемы",
                 "6" : "Проблемы в сельскохозяйственном направлении",
            }

            return levels[level];
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