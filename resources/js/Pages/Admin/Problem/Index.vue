<template>
    <AdminLayout>
        <Head title="Проблемные вопросы" />
        <div>
            <h1 class="text-center">Проблемные вопросы</h1>
            <button @click="openModal = true" class="btn btn-success ml-3">Добавить проблемный вопрос</button>
            <h5 class="p-3">
                Фильтр
                <i class="fa fa-filter" @click="this.showFillter = this.showFillter ? false : true" style="padding: 5px; cursor:pointer"></i>
            </h5>
            <div class="filter-panel">
                <div v-if="showFillter">
                    <div class="form-group">
                        <label for="show_dashboard">Показывать в dashboard</label>
                        <select class="form-control" id="show_dashboard" v-model="fillter.visible">
                            <option value="" selected disabled >Выберите значение</option>
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Период</label>
                        <div>
                            <date-range-picker
                                    ref="picker"
                                    :opens="'right'"
                                    :dateRange="dateRange"
                                    v-model="dateRange"
                        />
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="typo__label">Регионы</label>
                            <multiselect id="option-groups" 
                                v-model="fillter.value_regions" 
                                :options="regions"
                                :multiple="true"
                                track-by="id"
                                label="title"
                                placeholder="Выберите регион"
                                >
                                
                                <template v-slot:noResult>Ничего не найден</template>
                            </multiselect>
                    </div>
                    <div class="form-group">
                        <label for="levels">Уровни/направления</label>
                        <multiselect id="option-groups" 
                            v-model="fillter.value_levels" 
                            :options="levels"
                            :multiple="true"
                            track-by="value"
                            label="title"
                            placeholder="Выберите уровень/направление..."
                            >
                            
                            <template v-slot:noResult>Ничего не найден</template>
                        </multiselect>
                    
                    </div>
                    <div class="filter-actions text-right">
                        <button class="btn btn-success mr-3" @click="filter_page()">Применить</button>
                        <button class="btn btn-secondary" @click="remove_filter_page()">Сбросить</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="max-height: 700px; overflow-y: auto; margin-top: 15px;">

                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Показывать в dashboard</th>
                    <th scope="col">Найменование</th>
                    <th scope="col">Дата создание</th> 
                    <th scope="col">Уровень</th>
                    <th scope="col">Город(города)</th>
                    <th scope="col">Ответственный</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="problem in problems" :class="problem.color">
                            <td scope="row ">{{ problem.id }}</td>
                            <td>
                                <div class="form-check form-switch ml-10">
                                    <input class="form-check-input" @click="updateVisible(problem)" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" :checked="problem.is_visible"  >
                                </div>
                           </td>
                            <td>{{ problem.title }}</td>
                            <td>{{ problem.created_at }}</td>
                            <td>{{ getProblemLevel(problem.level) }}</td>
                            <td>{{ problem.regions }}</td>
                            <td>{{ problem.username }}</td>
                            <td>
                                <button type="button" @click="show(problem)" class="btn btn-outline-primary">Редактировать</button>
                                <button type="button" @click="deleteAction(problem.id)"  class="btn btn-outline-danger">Удалить</button>
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
                                    <h4 class="modal-title">Добавить проблемный вопрос</h4>
                                  
                                    <button type="button" @click="openModal = false"><span aria-hidden="true">&times;</span></button> 
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="storeAction">
                                        <div class="form-group">
                                            <label for="color">Проект</label>
                                            <select class="form-control" id="color" v-model="form.project_id" >
                                                <option value="" disabled>Выберите проект...</option>
                                                <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="levels">Уровни/направления</label>
                                            <select class="form-control" id="levels" v-model="form.level"> 
                                                <option value="" disabled>Выберите уровень/направление...</option>
                                                <option value="republic">Республиканский уровень</option>
                                                <option value="obl">Областной уровень</option>
                                                <option value="city">Городской уровень</option>
                                                <option value="1">Системообразующие предприятия</option>
                                                <option value="2">Проблемные ЖК (дольщики)</option>
                                                <option value="3">Проблемы в сфере ЖКХ и автодорог</option>
                                                <option value="4">Другие социальные проблемы</option>
                                                <option value="5">Экологические проблемы</option>
                                                <option value="6">Проблемы в сельскохозяйственном направлении</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="color">Цвет</label>
                                            <select class="form-control" id="color" v-model="form.color">
                                                <option value="" disabled>Выберите цвет...</option>
                                                <option value="neu">Нейтральный (без цвета)</option>
                                                <option value="warning">Оранжевый</option>
                                                <option value="yellow">Желтый</option>
                                                <option value="danger">Красный (danger)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div><label class="typo__label">Регионы</label>
                                                <multiselect id="option-groups" 
                                                    v-model="form.value_regions" 
                                                    :options="regions"
                                                    :multiple="true"
                                                    track-by="id"
                                                    label="title"
                                                    placeholder="Выберите регион"
                                                   >
                                                    
                                                    <template v-slot:noResult>Ничего не найден</template>
                                                </multiselect>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Название проблемы</label>
                                            <textarea class="form-control" id="name" v-model="form.title"  rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Текущее состояние</label>
                                            <textarea class="form-control" id="status"  v-model="form.status"  rows="6"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="result">Принимаемые меры (результаты работы): </label>
                                            <textarea class="form-control" id="result" v-model="form.result"  rows="6"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="dropzone">Добавить изображения в медиагалерею</label>
                                            <vue-dropzone ref="myVueDropzone" @vdropzone-file-added="fileAdded" @vdropzone-removed-file="removedFile"  id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" :disabled="!form.title || !form.status || !form.result || !form.value_regions ||
                                                                             !form.level || !form.color || !form.project_id" class="btn btn-primary">Добавить</button>
                                            <button type="button"  @click="openModal = false" class="btn btn-white">Закрыть</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Problem Modal -->
            <div v-if="editModal" class="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div :class="`modal-header ${editForm.color}`">
                            <h5 class="modal-title">Редактировать проблемный вопрос</h5>
                            <button class="close" @click="editModal = false"> <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="updateAction">
                                <div class="form-group">
                                    <label for="color">Проект</label>
                                    <select class="form-control" id="color" v-model="editForm.project_id" >
                                        <option value="" disabled>Выберите проект...</option>
                                        <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="levels">Уровни/направления</label>
                                    <select class="form-control" id="levels" v-model="editForm.level"> 
                                        <option value="" disabled>Выберите уровень/направление...</option>
                                        <option value="republic">Республиканский уровень</option>
                                        <option value="obl">Областной уровень</option>
                                        <option value="city">Городской уровень</option>
                                        <option value="1">Системообразующие предприятия</option>
                                        <option value="2">Проблемные ЖК (дольщики)</option>
                                        <option value="3">Проблемы в сфере ЖКХ и автодорог</option>
                                        <option value="4">Другие социальные проблемы</option>
                                        <option value="5">Экологические проблемы</option>
                                        <option value="6">Проблемы в сельскохозяйственном направлении</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="color">Цвет</label>
                                    <select class="form-control" id="color" v-model="editForm.color">
                                        <option value="" disabled>Выберите цвет...</option>
                                        <option value="neu">Нейтральный (без цвета)</option>
                                        <option value="warning">Оранжевый</option>
                                        <option value="yellow">Желтый</option>
                                        <option value="danger">Красный (danger)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div><label class="typo__label">Регионы</label>
                                        <multiselect id="option-groups" 
                                            v-model="editForm.value_regions" 
                                            :options="regions"
                                            :multiple="true"
                                            track-by="id"
                                            label="title"
                                            placeholder="Выберите регион"
                                            >
                                            
                                            <template v-slot:noResult>Ничего не найден</template>
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Название проблемы</label>
                                    <textarea class="form-control" id="name" v-model="editForm.title"  rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Текущее состояние</label>
                                    <textarea class="form-control" id="status"  v-model="editForm.status"  rows="6"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="result">Принимаемые меры (результаты работы): </label>
                                    <textarea class="form-control" id="result" v-model="editForm.result"  rows="6"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="dropzone">Добавить изображения в медиагалерею</label>
                                    <vue-dropzone ref="myVueDropzone" @vdropzone-file-added="editFileAdded" @vdropzone-removed-file="editRemovedFile"  id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                                </div>
                                <div class="form-group">
                                    <button type="submit" :disabled="!editForm.title || !editForm.status || !editForm.result || !editForm.value_regions ||
                                                                        !editForm.level || !editForm.color || !editForm.project_id" class="btn btn-primary">Обновить</button>
                                    <button type="button"  @click="editModal = false" class="btn btn-white">Закрыть</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DateRangePicker from 'vue3-daterange-picker';
import vueDropzone from 'vue2-dropzone-vue3'
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'
import {createProblem,getProblems,udpateProblem,updateProblemVisible,deleteProblem} from '@/Use/api/problems';
import {getRegions} from '@/Use/api/regions';
import { getProjects } from '@/Use/api/projects';
import {projects,regions,problems} from '@/Use/data/items';

export default {
    name:'Index',
    components: {AdminLayout,Head,Link,Multiselect,vueDropzone,DateRangePicker},

    data(){
        return {
            dateRange : {
                startDate: new Date().toISOString().split('T')[0],  // Получаем YYYY-MM-DD
                endDate: new Date().toISOString().split('T')[0],
            },
            fillter: {
                startDate: '',  
                endDate: '',
                visible:'',
                value_levels:[],
                value_regions:[]
            },
            form : useForm({
                    title: '',
                    status : '',
                    result : '',
                    value_regions: [],
                    images : [],
                    level : '',
                    color : '',
                    project_id : '',
            }),
            editForm : useForm({
                    id: '',
                    title: '',
                    status : '',
                    result : '',
                    value_regions: [],
                    images : [],
                    level : '',
                    color : '',
                    project_id : '',
            }),
            user_id : usePage().props.auth.user.id,
            dropzone: null,
            openModal:false,
            showFillter:false,
            editModal:false,
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 150,
                maxFilesize: 100,
                clickable : true,
                addRemoveLinks: true,
                dictDefaultMessage: "Перетащите файлы сюда или нажмите для загрузки",
                acceptedFiles : 'image/jpeg, image/png, image/jpg'
            },
            levels: [
                {
                    value: "republic",
                    title: 'Республиканский уровень'
                },
                {
                    value: "obl",
                    title: 'Областной уровень'
                },
                {
                    value: "city",
                    title: 'Городской уровень'
                },
                {
                    value: "1",
                    title: 'Системообразующие предприятия'
                },
                {
                    value: "2",
                    title: 'Проблемные ЖК (дольщики)'
                },
                {
                    value: "3",
                    title: 'Проблемы в сфере ЖКХ и автодорог'
                },
                {
                    value: "4",
                    title: 'Другие социальные проблемы'
                },
                {
                    value: "5",
                    title: 'Экологические проблемы'
                },
                {
                    value: "6",
                    title: 'Проблемы в сельскохозяйственном направлении'
                },
            ]
        }
    },

    methods: {
        storeAction() {
            createProblem(this.form,this.user_id);
            this.openModal = false;
        },
        updateAction(){
            udpateProblem(this.editForm);
            this.editModal = false;
        },
        deleteAction(id){ 
            deleteProblem(id)
        },

        fileAdded(file){this.form.images.push(file) },
        removedFile(file){this.form.images = this.form.images.filter(f => f !== file);},
        editFileAdded(file){this.editForm.images.push(file)},
        editRemovedFile(file){this.editForm.images = this.editForm.images.filter(f => f !== file);},

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

        show(problem){
            this.editModal = true;
            this.editForm.id = problem.id;
            this.editForm.title = problem.title;
            this.editForm.status = problem.status;
            this.editForm.result = problem.result;
            this.editForm.level = problem.level;
            this.editForm.color = problem.color;
            this.editForm.project_id = problem.project_id;
            const regions = problem.regions.split(',').map((region) => region.trim());
            this.editForm.value_regions = this.regions.filter((region) => regions.find((el) => region.title == el));
            if(problem.images.length > 0){
                this.dropzoneOptions.init = function(){
                    const images = problem.images.map((image) => `/storage/${image}`);
                    images.forEach((path) => {
                        let mockFile = { name: path.split('/').pop(), size: 12345 }; // Генерируем имя
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, path); // Указываем путь к изображению
                        this.emit("complete", mockFile);
                    });
                }
            }else{
                this.dropzoneOptions.init = function(){
                    this.removeAllFiles(true); // Очищает Dropzone
                };
            }
        },
       
        updateVisible(problem) {
            problem.is_visible = problem.is_visible == 0 ? 1 : 0;
            updateProblemVisible(problem.id,problem.is_visible)
        },
       
    },

    setup(){return {projects,regions,problems}},

    mounted(){
        getProjects(this.user_id);
        getProblems();
        getRegions();
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

.danger{
    background-color: #ee6b6b !important;
}
.warning{
    background-color: #ec8231 !important;
}
.yellow{
    background-color: #f0e732 !important;
}
.filter-panel{
    padding: 15px;
    width: 60%;
}

</style>