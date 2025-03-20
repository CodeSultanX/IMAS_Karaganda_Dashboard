<template>
    <AdminLayout>
        <Head title="Проблемные вопросы" />
        <div>
            <h1 class="text-center">Проекты</h1>
            <button @click="openModal = true" class="btn btn-success ml-3">Добавить проект</button>

            <div class="table-responsive" style="max-height: 700px; overflow-y: auto; margin-top: 15px;">

                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Найменование</th>
                    <th scope="col">f_date</th>
                    <th scope="col">s_date</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="project in projects">
                            <td scope="row ">{{ project.id }}</td>
                            <td>{{ project.name }}</td>
                            <td>{{ project.f_date }}</td>
                            <td>{{ project.s_date }}</td>
                            <td>
                                <button type="button" @click="show(project)" class="btn btn-outline-primary">Редактировать</button>
                                <button type="button" @click="deleteAction(project.id)"  class="btn btn-outline-danger">Удалить</button>
                            </td>
                        </tr>
                </tbody>
                </table>
            </div>
        </div>

          <!-- Add Problem Modal -->
          <div v-if="openModal" class="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal inmodal " >
                        <form class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-green-300">
                                    <h4 class="modal-title">Добавить проект</h4>
                                    <button type="button" @click="openModal = false"><span aria-hidden="true">&times;</span></button> 
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="storeAction">
                                        <div class="form-group">
                                            <label for="title">Найменование</label>
                                            <input type="text" class="form-control" v-model="form.title" id="title">
                                        </div>
                                        <date-range-picker
                                            ref="picker"
                                            :opens="'left'"
                                            :dateRange="dateRange"
                                            v-model="dateRange"
                                        />
                                      
                                        <div class="form-group">
                                            <button type="submit" :disabled="!form.title" class="btn btn-primary">Добавить</button>
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
                                    <h4 class="modal-title">Редактировать проект</h4>
                                    <button type="button" @click="editModal = false"><span aria-hidden="true">&times;</span></button> 
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="updateAction">
                                        <div class="form-group">
                                            <label for="title">Найменование</label>
                                            <input type="text" class="form-control" v-model="EditForm.title" id="title">
                                        </div>
                                        <date-range-picker
                                            ref="picker"
                                            :opens="'left'"
                                            :dateRange="dateRange"
                                            v-model="dateRange"
                                        />
                                      
                                        <div class="form-group">
                                            <button type="submit" :disabled="!EditForm.title" class="btn btn-primary">Обновить</button>
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
import DateRangePicker from 'vue3-daterange-picker';
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import {createProject,getProjects,updateProject,deleteProject} from '@/Use/api/projects';
import {projects} from '@/Use/data/items';

export default {
    name:'Index',
    components: {AdminLayout,Head,Link,DateRangePicker},

    data(){
        return {
            dateRange : {
                startDate: new Date().toISOString().split('T')[0],  // Получаем YYYY-MM-DD
                endDate: new Date().toISOString().split('T')[0],
            },
            form : useForm({
                    title: '',
                    startDate: '',  
                    endDate: '',
            }),
            EditForm : useForm({
                    id: '',
                    title: '',
                    startDate: '',  
                    endDate: '',
            }),
            user_id : usePage().props.auth.user.id,
            openModal:false,
            editModal:false,
        }
    },

    methods: {
         storeAction() {
            this.form.startDate = this.dateRange.startDate;
            this.form.endDate = this.dateRange.endDate;
            createProject(this.form,this.user_id);
            this.openModal = false;
        },
         updateAction() {
            updateProject(this.EditForm,this.user_id);
            this.editModal = false;
        },
        
        show(project){
            this.editModal  = true;
            this.EditForm.id = project.id;
            this.EditForm.title = project.name;
            this.dateRange.startDate = project.f_date;
            this.dateRange.endDate = project.s_date;

            this.EditForm.startDate = project.f_date;
            this.EditForm.endDate = project.s_date;

        },
        deleteAction(id){ 
            deleteProject(id,this.user_id)
        },

    },

    setup(){return {projects}},

    mounted(){
        getProjects(this.user_id);
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