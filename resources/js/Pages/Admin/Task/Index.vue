<template>
    <AdminLayout>
        <Head title="Пометки/поручение" />
        <div>
            <h1 class="text-center">Пометки/поручение</h1>

            <div class="table-responsive" style="max-height: 700px; overflow-y: auto; margin-top: 15px;">

                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Проблемный вопрос</th>
                        <th scope="col">Пометка/Поручение</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="task in tasks">
                            <td scope="row ">{{ task.id }}</td>
                            <td>{{ task.problem_name }}</td>
                            <td>{{ typeText(task.type) }}</td>
                            <td>
                                <button v-if="!task.type" type="button" @click="create(task)" class="btn btn-outline-primary">Добавить</button>
                                <button v-if="task.type" type="button" @click="show(task)" class="btn btn-outline-primary">Редактировать</button>
                                <button type="button" @click="deleteAction(task.id)"  class="btn btn-outline-danger">Удалить</button>
                            </td>
                        </tr>
                </tbody>
                </table>
            </div>
        </div>

         
          <!-- Open Modal -->
          <div v-if="openModal" class="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal inmodal " >
                        <form class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-green-300">
                                    <h4 class="modal-title">{{ form.problem_name }}</h4>
                                    <button type="button" @click="openModal = false"><span aria-hidden="true">&times;</span></button> 
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="submit">
                                        <div class="form-group">
                                            <label for="type">Пометка/Задача</label>
                                            <select class="form-control" id="type" v-model="form.type"> 
                                                <option value="" disabled>Выберите пометку или задачу</option>
                                                <option value="note">Пометка</option>
                                                <option value="task">Поручение</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea class="form-control" id="content"  v-model="form.content"  rows="6"></textarea>
                                        </div>
                                        
                                      
                                        <div class="form-group">
                                            <button type="submit" :disabled="!form.type || !form.content" class="btn btn-primary">Добавить</button>
                                            <button type="button"  @click="openModal = false" class="btn btn-white">Закрыть</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
          </div>
          <!-- Edit Modal -->
          <div v-if="editModal" class="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal inmodal " >
                        <form class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-green-300">
                                    <h4 class="modal-title">{{ EditForm.problem_name }}</h4>
                                    <button type="button" @click="editModal = false"><span aria-hidden="true">&times;</span></button> 
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="update">
                                        <div class="form-group">
                                            <label for="type">Пометка/Задача</label>
                                            <select class="form-control" id="type" v-model="EditForm.type"> 
                                                <option value="" disabled>Выберите пометку или задачу</option>
                                                <option value="note">Пометка</option>
                                                <option value="task">Поручение</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Статус</label>
                                            <select class="form-control" id="status" v-model="EditForm.status"> 
                                                <option value="in_progress">В процессе</option>
                                                <option value="completed">Завершен</option>
                                                <option value="pending">в ожидании</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Описание</label>
                                            <textarea class="form-control" id="content"  v-model="EditForm.content"  rows="6"></textarea>
                                        </div>
                                      
                                        <div class="form-group">
                                            <button type="submit" :disabled="!EditForm.type || !EditForm.content" class="btn btn-primary">Обновить</button>
                                            <button type="button"  @click="editModal = false" class="btn btn-white">Закрыть</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
          </div>

           

        
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import {createTask,deleteTask,getTasks,updateTask} from '@/Use/api/tasks';
import {tasks} from '@/Use/data/items';

export default {
    name:'Index',
    components: {AdminLayout,Head,Link},

    data(){
        return {
            dateRange : {
                startDate: new Date().toISOString().split('T')[0],  // Получаем YYYY-MM-DD
                endDate: new Date().toISOString().split('T')[0],
            },
            form : useForm({
                id: '',
                problem_name: '',
                type: '',
                content: '',  
            }),
            EditForm : useForm({
                task_id: '',
                problem_name: '',
                type: '',
                content: '',  
                status: '',  
            }),
            user_id : usePage().props.auth.user.id,
            openModal:false,
            editModal:false,
        }
    },

    methods: {
        submit() {
            createTask(this.form,this.user_id);
            this.openModal = false;
        },
        update() {
            updateTask(this.EditForm,this.user_id);
            this.editModal = false;
        },

        create(task)
        {
            this.form.id = task.id;
            this.form.problem_name = task.problem_name;
            this.openModal = true;
        },
        
        show(task){
            this.editModal  = true;
            this.EditForm.task_id = task.task_id;
            this.EditForm.type = task.type;
            this.EditForm.content = task.content;
            this.EditForm.problem_name = task.problem_name;
            this.EditForm.status = task.status;
        },
        deleteAction(id){ 
            deleteTask(id,this.user_id)
        },
        typeText(text){
            if(text == null) return 'Нет пометки/Поручение'
            return text == 'note' ? 'Пометка' : 'Поручение'
        }

    },

    setup(){return {tasks}},

    mounted(){
        getTasks(this.user_id);
    }
   
}


</script>


<style scoped>
.modal {
  position: fixed;
  top: 5%;
  width: 100%;
  display: block;
  max-height: 80vh;
  overflow-y: auto;
}

.modal-content{
    box-shadow: none !important;
}


</style>