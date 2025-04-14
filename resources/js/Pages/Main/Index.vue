<template>
    <DashboardLayout>
        <div class="parent-item">
            <div>
                <Dynamic/>

                <Category :counts_problem = 'problems' />
            </div>
            <!-- Центр -->
            <Map/>

            <!-- Правый блок -->
            <ProblemList />
        </div>
    </DashboardLayout>

</template>

<script>
import '../../../css/dashboard_imas.css'


import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Dynamic from '@/Components/Main/Dynamic.vue';
import Category from '@/Components/Main/Category.vue';
import Map from '@/Components/Main/Map.vue';
import ProblemList from '@/Components/Main/ProblemList.vue';
import {getCategoriesProblems} from '@/Use/api/main';
import { problems } from '@/Use/data/items';

export default {
    name:'Index',
    components: {DashboardLayout,Dynamic,Category,Map,ProblemList},
   

    mounted(){
        getCategoriesProblems();
    },

    setup(){ return { problems}}
}


</script>