<template>
    <DashboardLayout>
        <div class="parent-item">
            <div>
                <Dynamic/>

                <Category />
            </div>
            <!-- Центр -->
            <Map/>

            <!-- Правый блок -->
            <ProblemList/>
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


export default {
    name:'Index',
    components: {DashboardLayout,Dynamic,Category,Map,ProblemList},
   
}


</script>